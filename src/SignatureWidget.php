<?php
namespace webtoolsnz\widgets;

use Yii;
use webtoolsnz\widgets\SignatureAsset;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class SignatureWidget extends InputWidget
{
    /**
     * @var array
     */
    public $inputOptions = [];

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

        $this->widgetId = sprintf('signature_pad_%s', $this->options['id']);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        Html::addCssClass($this->inputOptions, 'form-control');
        $this->inputOptions['id'] = $this->widgetId;

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
        SignatureAsset::register($view);

        $options = json_encode([]);

        $js[] = "$('#{$this->widgetId}').signatureWidget($options)";
        $view->registerJs(implode("\n", $js));
    }
}
