<?php
namespace webtoolsnz\widgets;

use yii\web\AssetBundle;

/**
 * Class SignatureAsset
 * @package webtoolsnz\widgets
 */
class SignatureAsset extends AssetBundle
{
    /**
     * @var array
     */
    public $js = [
        'js/signature.js',
    ];

    public $css = [
        'css/signature.css',
    ];

    /**
     * @var array
     */
    public $depends = [
        'webtoolsnz\widgets\SignaturePadAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];

    /**
     *
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}
