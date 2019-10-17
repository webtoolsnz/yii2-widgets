<?php

namespace tests;

use webtoolsnz\widgets\GooglePlaceSearchAsset;
use Yii;
use yii\web\AssetBundle;

class GooglePlaceSearchAssetTest extends TestCase
{
    public function testBundleRegistratoion()
    {
        $view = Yii::$app->getView();
        $this->assertEmpty($view->assetBundles);

        GooglePlaceSearchAsset::register($view);

        $this->assertEquals(2, count($view->assetBundles));
        $this->assertArrayHasKey('webtoolsnz\\widgets\\GooglePlaceSearchAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['webtoolsnz\\widgets\\GooglePlaceSearchAsset'] instanceof AssetBundle);
    }

    public function testAutomaticApiKeyInjection()
    {
        $view = Yii::$app->getView();
        Yii::$app->params['google.api.key'] = 'APP_PARAMS_KEY';

        GooglePlaceSearchAsset::register($view);

        $content = $view->renderFile('@tests/views/layouts/raw.php');
        $expected = '//maps.googleapis.com/maps/api/js?libraries=places&amp;key=APP_PARAMS_KEY';

        $this->assertStringContainsString($expected, $content);
    }

    public function testManualApiKeyInjection()
    {
        $view = Yii::$app->getView();
        $this->assertEmpty($view->assetBundles);

        GooglePlaceSearchAsset::$apiKey = 'MANUAL_API_KEY';
        GooglePlaceSearchAsset::register($view);

        $content = $view->renderFile('@tests/views/layouts/raw.php');
        $expected = '//maps.googleapis.com/maps/api/js?libraries=places&amp;key=MANUAL_API_KEY';

        $this->assertStringContainsString($expected, $content);
    }
}