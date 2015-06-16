<?php
/**
 * @link https://bitbucket.org/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\widgets;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use yii\jui\JuiAsset;
use yii\helpers\FormatConverter;
use Yii;


class DatePicker extends InputWidget
{
    /**
     * Display format for date field
     *
     * @var String
     */
    public $dateFormat;

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
    public $value;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();

        Html::addCssClass($this->options, 'progressive-datepicker');

        if (!$this->dateFormat) {
            $this->dateFormat = Yii::$app->formatter->dateFormat;
        }

        if (strncmp($this->dateFormat, 'php:', 4) === 0) {
            $this->clientOptions['dateFormat'] = FormatConverter::convertDatePhpToJui(substr($this->dateFormat, 4));
        } else {
            $this->clientOptions['dateFormat'] = FormatConverter::convertDateIcuToJui($this->dateFormat);
        }

        $this->options = array_merge($this->options, [
            'type' => 'date',
            'value' => $this->getDate(),
            'formattedValue' => $this->getFormattedDate(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->options['value'], $this->options);
        }

        $this->registerClientScript();
    }

    /**
     * Registers wysihtml5 plugin and the related events
     */
    protected function registerClientScript()
    {
        $view = $this->getView();

        DatePickerAsset::register($view);
        JuiAsset::register($view);

        $id = $this->options['id'];
        $options = Json::encode($this->clientOptions);
        $view->registerJs("jQuery('#$id').progressiveDatePicker('{$this->options['formattedValue']}', $options);");
    }

    public function getDate()
    {
        // get formatted date value
        if ($this->hasModel()) {
            $value = Html::getAttributeValue($this->model, $this->attribute);
        } else {
            $value = $this->value;
        }

        return $value;
    }

    public function getFormattedDate()
    {
        $value = $this->getDate();

        if ($value !== null && $value !== '') {
            // format value according to dateFormat
            try {
                $value = Yii::$app->formatter->asDate($value, $this->dateFormat);
            } catch(InvalidParamException $e) {
                // ignore exception and keep original value if it is not a valid date
            }
        }

        return $value;
    }
}
