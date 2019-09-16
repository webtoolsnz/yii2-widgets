<?php
/**
 * Asset for bootbox plugin
 * @author Brusenskiy Dmitry <brussens@nativeweb.ru>
 * @author Christopher Henderson <chris@inspiral.co.nz>
 *
 * @link https://github.com/webtoolsnz/yii2-widgets
 * @link https://github.com/yiiassets/yii2-bootbox-asset
 * @link http://bootboxjs.com/
 * @copyright 2015 Brusenskiy Dmitry
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace webtoolsnz\widgets;


use Yii;
use yii\web\AssetBundle;

class BootBoxAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootbox.js';

    public $js = [
        'bootbox.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
