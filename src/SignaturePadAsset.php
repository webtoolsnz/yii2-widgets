<?php
namespace webtoolsnz\widgets;

use yii\web\AssetBundle;

/**
 * Class SignaturePadAsset
 * @package webtoolsnz\widgets
 */
class SignaturePadAsset extends AssetBundle
{
    public $js = [
        'signature_pad.min.js',
    ];

    public function init()
    {
        $this->sourcePath = '@bower/signature_pad';
        parent::init();
    }
}
