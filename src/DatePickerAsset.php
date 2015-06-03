<?php
/**
 * @link https://bitbucket.org/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */
namespace webtoolsnz\widgets;

use yii\web\AssetBundle;

/**
 * Class DatePickerAsset
 * @package webtoolsnz\widgets
 */
class DatePickerAsset extends AssetBundle
{
    public $js = [
        'js/progressive-datepicker.js',
    ];

    public $depends = [
        'yii\jui\JuiAsset',
        'webtoolsnz\widgets\ModernizrAsset',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}
