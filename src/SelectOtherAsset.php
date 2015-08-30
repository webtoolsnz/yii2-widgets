<?php
/**
 * @link https://bitbucket.org/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\widgets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Class SelectOtherAsset
 * @package webtoolsnz\widgets
 */
class SelectOtherAsset extends AssetBundle
{
    public $js = [
        'js/select-other.js',
    ];

    public $css = [
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init()
    {
        parent::init();
        $this->sourcePath = __DIR__ . '/assets';
    }
}
