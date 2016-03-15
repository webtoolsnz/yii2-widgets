<?php
/**
 * @link https://github.com/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */
namespace webtoolsnz\widgets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Class DatePickerAsset
 * @package webtoolsnz\widgets
 */
class DateRangePickerAsset extends AssetBundle
{
    public $js = [
        'js/moment.min.js',
        'js/daterangepicker.js',
    ];

    public $css = [
        'css/daterangepicker.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}
