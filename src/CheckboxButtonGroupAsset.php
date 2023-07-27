<?php
/**
 * @link https://github.com/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\widgets;

use yii\web\AssetBundle;

/**
 * Class CheckboxButtonGroupAsset
 * @package webtoolsnz\widgets
 */
class CheckboxButtonGroupAsset extends AssetBundle
{
    public $js = [
        'js/checkbox-button-group.js',
    ];

    public $css = [
        'css/radio-button-group.css'
    ];

    public $depends = [
        'yii\bootstrap4\BootstrapPluginAsset',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}
