<?php
/**
 * @link https://github.com/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\widgets;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;
use yii\helpers\FormatConverter;
use Yii;


class DateRangePicker extends InputWidget
{
    /**
     * Display format for date field
     *
     * @var String
     */
    public $dateFormat;

    public $parentSelectorHide = '.form-group';

    /*
    * @var String
    */
    public $start_attribute;
    public $end_attribute;

    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var array
     */
    public $options = [];

    /**
     * @var String
     */
    public $value = '';

    /**
     * @var String
     */
    public $separator = ' - ';

    /**
     * @var bool
     */
    public $displayIcon = false;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
            $this->name = $this->getId();
        }

        if (!$this->hasModel()) {
            throw new InvalidConfigException("DateRangePicker requires a model, check docs for usage.");
        }

        Html::addCssClass($this->options, ['date-range-picker', 'form-control']);


        if (!$this->dateFormat) {
            $this->dateFormat = Yii::$app->formatter->dateFormat;
        }
        if ($this->getDate('start') && $this->getDate('end')) {
            $this->clientOptions['startDate'] = new JsExpression('moment("'.$this->getDate('start').'")');
            $this->clientOptions['endDate'] =  new JsExpression('moment("'.$this->getDate('end').'")');
        }

        $dateFormat = $this->dateFormat;
        if (strncmp($this->dateFormat, 'php:', 4) === 0) {
            $dateFormat = FormatConverter::convertDatePhpToIcu(substr($this->dateFormat, 4));
        }
        $this->clientOptions['locale'] = [
            'format' => MomentFormatConverter::convert($dateFormat)
        ];

    }


    /**
     * @inheritdoc
     */
    public function run()
    {
        /*if ($this->hasModel()) {
            $input = Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {*/
            $input = Html::textInput($this->name, $this->value, $this->options);
        //}

        if ($this->displayIcon) {
            $icon = Html::tag('span', null, ['class' => 'glyphicon glyphicon-calendar']);
            $addon = Html::tag('div', $icon, ['class' => 'input-group-addon']);
            $input = Html::tag('div', $addon.$input, ['class' => 'input-group']);
        }

        echo $input;

        $this->registerClientScript();
    }

    /**
     * Registers wysihtml5 plugin and the related events
     */
    protected function registerClientScript()
    {
        $view = $this->getView();

        DateRangePickerAsset::register($view);

        $id = $this->options['id'];

        $options = Json::encode($this->clientOptions);
        $startInputId = Json::encode('#'.Html::getInputId($this->model, $this->start_attribute));
        $endInputId = Json::encode('#'.Html::getInputId($this->model, $this->end_attribute));

        $fn = new JsExpression(<<<JS
function(ev, picker) {
    elS.val(picker.startDate.format('YYYY-MM-DD'));
    elE.val(picker.endDate.format('YYYY-MM-DD'));
}
JS
);
        $selector = Json::encode($this->parentSelectorHide);
        $view->registerJs(<<<JS
(function () {
    var elS = $($startInputId),
        elE = $($endInputId);
    jQuery('#$id')
        .daterangepicker($options)
        .on('apply.daterangepicker', $fn);

    elS.parents($selector).hide();
    elE.parents($selector).hide();
})();
JS
);

    }

    public function getDate($date = 'start')
    {
        // get formatted date value

        $value = Html::getAttributeValue(
            $this->model,
            $date == 'start' ? $this->start_attribute : $this->end_attribute
        );


        return $value;
    }

    public function hasModel()
    {
        return ($this->model instanceof Model);
    }
}
