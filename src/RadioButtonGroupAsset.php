<?php
/**
 * @link https://github.com/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\widgets;

use yii\web\AssetBundle;

/**
 * Class RadioButtonGroupAsset
 * @package webtoolsnz\widgets
 */
class RadioButtonGroupAsset extends AssetBundle
{
    public $js = [
        'js/radio-button-group.js',
    ];

    public $css = [
        'css/radio-button-group.css'
    ];

    public $depends = [
        'yii\bootstrap5\BootstrapPluginAsset',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}
