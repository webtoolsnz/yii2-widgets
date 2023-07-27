<?php
/**
 * @link https://gihub.com/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\widgets;

use yii\widgets\InputWidget;
use Yii;
use yii\helpers\Html;


class CurrencyInput extends InputWidget
{
    public $currencySymbol;

    public function init()
    {
        parent::init();

        $this->options = array_merge([
            'type' => 'number',
            'step' => '0.01',
            'min' => 0
        ], $this->options);

        Html::addCssClass($this->options, 'form-control');

        if (!$this->currencySymbol) {
            if (null === ($code = Yii::$app->formatter->currencyCode)) {
                $code = 'USD';
            }

            $this->currencySymbol = \Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($code);
        }
    }

    public function run()
    {
        echo '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text">'.$this->currencySymbol.'</span></div>';

        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }

        echo '</div>';
    }
}
