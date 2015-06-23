<?php

namespace webtoolsnz\widgets;

use yii\web\AssetBundle;


class GooglePlaceSearchAsset extends AssetBundle
{
    public $js = [
        'https://maps.googleapis.com/maps/api/js?libraries=places',
        'js/google-place-search.js',
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
