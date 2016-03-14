<?php
/**
 * @link https://github.com/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use Yii;

/**
 * CheckboxButtonGroup renders a bootstrap style button group for checkbox options
 *
 * @author Byron Adams <byron@webtools.co.nz>
 * @package webtoolsnz\yii2-widgets
 */
class CheckboxButtonGroup extends InputWidget
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
    public $items = [];

    /**
     * @var null
     */
    public $widgetId = null;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->widgetId = sprintf('checkbox_button_%s', $this->options['id']);

        $this->itemOptions = array_merge([
            self::STATE_ACTIVE => 'active btn btn-success',
            self::STATE_DEFAULT => 'btn btn-default',
            'buttons' => [],
        ], $this->itemOptions);
    }

    /**
     * @param $value
     * @param $selectedValue
     * @return string
     */
    public function getButtonClass($value, $selectedValue)
    {
        $selectedValue = is_array($selectedValue) ? in_array($value, $selectedValue) : $selectedValue;
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
     * render the html input for the widget
     */
    protected function renderInput()
    {
        if ($this->hasModel()) {
            $content = Html::activeCheckboxList(
                $this->model,
                $this->attribute,
                $this->items,
                $this->options
            );
        } else {
            $content = Html::checkboxList(
                $this->name,
                $this->value,
                $this->items,
                $this->options
            );
        }

        return Html::tag(
            'div',
            $content,
            [
                'id' => $this->widgetId.'-checkbox',
                'class' => 'checkbox_button_group'.'_checkbox',
            ]
        );
    }

    /**
     * Executes the widget.
     * @return string the result of widget execution to be outputted.
     */
    public function run()
    {
        $this->registerClientScript();
        return Html::tag(
            'div',
            $this->renderInput().$this->renderButtons(),
            [
                'id' => $this->widgetId
            ]
        );
    }

    /**
     * Registers widget assets
     */
    protected function registerClientScript()
    {
        $view = $this->getView();
        CheckboxButtonGroupAsset::register($view);

        $id = $this->widgetId;
        $options =  Json::encode(
            ArrayHelper::merge(
                $this->itemOptions,
                [
                    'checkboxes' =>  '#'.$this->widgetId.'-checkbox'
                ]
            )
        );
        $js = "jQuery('#$id').checkboxButtonGroup($options);";
        $view->registerJs($js);

        $js = [
            "jQuery('#$id-buttons').show();",
            "jQuery('#$id-checkbox').hide();"
        ];

        $view->registerJs(
            implode("\n", $js),
            \yii\web\View::POS_END
        );
    }

    /**
     * @return string
     */
    private function renderButtons()
    {
        $buttons = '';

        foreach ($this->items as $value => $label) {
            $buttons .= Html::button($label, [
                'data-value' => $value,
                'class' => $this->getButtonClass(
                    $value,
                    $this->hasModel() ? Html::getAttributeValue($this->model, $this->attribute) : $this->value
                ),
            ]);
        }

        $class = 'btn-group checkbox-button-group';
        if (isset($this->options['class'])) {
            $class .= ' '.$this->options['class'];
        }

        return Html::tag('div', $buttons, [
            'class' => $class,
            'style' => 'display: none;',
            'id' => $this->widgetId.'-buttons',
        ]);
    }
}
