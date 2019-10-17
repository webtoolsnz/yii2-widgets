<?php

namespace webtoolsnz\widgets;

use yii\web\AssetBundle;
use yii\helpers\ArrayHelper;


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
        if (!self::$apiKey) {
            self::$apiKey = ArrayHelper::getValue(\Yii::$app->params, 'google.api.key', null);
        }

        $googleUrl = sprintf('//maps.googleapis.com/maps/api/js?libraries=places&key=%s', self::$apiKey);

        array_unshift($this->js, $googleUrl);

        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}
