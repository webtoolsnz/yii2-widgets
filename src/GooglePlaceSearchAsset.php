<?php

namespace webtoolsnz\widgets;

use yii\web\AssetBundle;


class GooglePlaceSearchAsset extends AssetBundle
{
    public static $apiKey;

    public $js = [
        'js/google-place-search.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init()
    {
        $googleUrl = '//maps.googleapis.com/maps/api/js?libraries=places';

        if (self::$apiKey) {
            $googleUrl .= '&key='.self::$apiKey;
        }

        array_unshift($this->js, $googleUrl);

        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}
