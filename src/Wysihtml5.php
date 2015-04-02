<?php
/**
 * @link https://bitbucket.org/webtoolsnz/yii2-wysihtml5
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\wysihtml5;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use Yii;

/**
 * Wysihtml5 renders a bootstrap3-wysiwyg plugin.
 * @see https://github.com/Waxolunist/bootstrap3-wysihtml5-bower
 * @author Byron Adams <byron@webtools.co.nz>
 * @package webtoolsnz\wysihtml5
 */
class Wysihtml5 extends InputWidget
{
    /**
     * @var array the options for the bootstrap3-wysiwyg plugin.
     * Please refer to the github page for possible options.
     * @see https://github.com/Waxolunist/bootstrap3-wysihtml5-bower
     */
    public $clientOptions = [];

    /**
     * default widget options for textarea
     *
     * @var array
     */
    public $options = [];

    public function init()
    {
        parent::init();

        $this->options = array_merge([
            'cols' => 95,
            'rows' => 7
        ], $this->options);

        $this->clientOptions = array_merge([
            'image' => false,
        ], $this->clientOptions);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextArea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textArea($this->name, $this->value, $this->options);
        }
        $this->registerClientScript();
    }

    /**
     * Registers wysihtml5 plugin and the related events
     */
    protected function registerClientScript()
    {
        $view = $this->getView();
        Wysihtml5Asset::register($view);

        $id = $this->options['id'];
        $options =  Json::encode($this->clientOptions);

        $js[] = "jQuery('#$id').wysihtml5($options);";
        $view->registerJs(implode("\n", $js));
    }
}
