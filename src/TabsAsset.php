<?php
/**
 * @link https://bitbucket.org/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\widgets;

use yii\web\AssetBundle;

/**
 * Class TabsAsset
 * @package webtoolsnz\widgets
 */
class TabsAsset extends AssetBundle
{
    public $js = [
        'js/linkable-tabs.js',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}
