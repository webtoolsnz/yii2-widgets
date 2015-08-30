<?php
/**
 * @link https://gihub.com/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use Yii;
use yii\helpers\Html;

/**
 * Class SelectOther
 * @package webtoolsnz\widgets
 */
class SelectOther extends InputWidget
{

    public $items = [];

    public $widgetId;

    public function init()
    {
        parent::init();
        $this->widgetId = sprintf('select_other_%s', $this->options['id']);

        Html::addCssClass($this->options, 'form-control');
    }

    /**
     * Executes the widget.
     * @return string the result of widget execution to be outputted.
     */
    public function run()
    {
        $readOnly = isset($this->options['readOnly']) && $this->options['readOnly'] == true;
        $disabled = isset($this->options['disabled'])
            && ($this->options['disabled'] == true || $this->options['disabled'] == 'disabled');

        if (!$disabled && !$readOnly) {
            $this->registerClientScript();
        }

        if ($this->hasModel()) {
            $textInput = Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            $textInput = Html::textInput($this->name, $this->value, $this->options);
        }

        return Html::tag(
            'div',
            $textInput,
            [
                'id' => $this->widgetId
            ]
        );
    }

    protected function registerClientScript()
    {
        $view = $this->getView();
        SelectOtherAsset::register($view);

        $options =  Json::encode(
            ArrayHelper::merge(
                $this->options,
                [
                    'items' =>  $this->items,
                    'selectClass' => 'form-control'
                ]
            )
        );

        $id = $this->widgetId;

        $js = "jQuery('#$id').selectOther($options);";
        $view->registerJs($js);
    }
}
