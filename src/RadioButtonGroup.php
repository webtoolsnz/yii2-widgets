<?php
/**
 * @link https://bitbucket.org/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\widgets;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use Yii;

/**
 * RadioButton renders a bootstrap style button group for radio options
 *
 * @author Byron Adams <byron@webtools.co.nz>
 * @package webtoolsnz\yii2-widgets
 */
class RadioButtonGroup extends InputWidget
{
    const STATE_ACTIVE = 'activeState';
    const STATE_DEFAULT = 'defaultState';

    /**
     * @var array the options for the radioButton plugin.
     */
    public $itemOptions = [];

    /**
     * @var array
     */
    public $inputOptions = [];

    /**
     * @var array
     */
    public $items = [];

    /**
     * @var null
     */
    public $widgetId = null;

    /**
     * @var bool
     */
    public $disabled = false;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->widgetId = sprintf('radio_button_%s', $this->options['id']);

        $this->itemOptions = array_merge([
            self::STATE_ACTIVE => 'active btn btn-success',
            self::STATE_DEFAULT => 'btn btn-default',
            'buttons' => [],
        ], $this->itemOptions);

        $this->inputOptions = array_merge(['id' => $this->options['id']], $this->inputOptions);
    }

    public function getButtonClass($value)
    {
        $selectedValue = $this->hasModel() ? Html::getAttributeValue($this->model, $this->attribute) : $this->value;
        $state = ($value == $selectedValue ? self::STATE_ACTIVE : self::STATE_DEFAULT);
        $buttonOptions = isset($this->itemOptions['buttons'][$value]) ? $this->itemOptions['buttons'][$value] : null;

        if ($buttonOptions && isset($buttonOptions[$state])) {
            $class = $buttonOptions[$state];
        } else {
            $class = $this->itemOptions[$state];
        }

        return $class;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $buttons = '';

        foreach ($this->items as $value => $label) {
            $buttons .= Html::button($label, [
                'data-value' => $value,
                'class' => $this->getButtonClass($value),
                'disabled' => $this->disabled,
            ]);
        }

        $class = 'radio-button-group';
        if (isset($this->options['class'])) {
            $class .= ' '.$this->options['class'];
        }

        echo Html::tag(
            'div',
            Html::tag('div', $buttons, [
                'class' => 'btn-group',
                'id' => $this->widgetId,
                'data-field' => '#'.$this->options['id'],
            ]),
            [
                'class' => $class,
            ]
        );

        if ($this->hasModel()) {
            echo Html::activeHiddenInput($this->model, $this->attribute, $this->inputOptions);
        } else {
            echo Html::hiddenInput($this->name, $this->value, $this->inputOptions);
        }

        $this->registerClientScript();
    }

    /**
     * Registers widget assets
     */
    protected function registerClientScript()
    {
        $view = $this->getView();
        RadioButtonGroupAsset::register($view);

        $id = $this->widgetId;
        $options =  Json::encode($this->itemOptions);

        $js[] = "jQuery('#$id').radioButtonGroup($options);";
        $view->registerJs(implode("\n", $js));
    }
}
