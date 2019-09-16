<?php

namespace tests;

use Yii;
use webtoolsnz\widgets\FontAwesomeAsset;
use yii\web\AssetBundle;

class FontAwesomeAssetTest extends TestCase
{
    public function testRegister()
    {
        $view = Yii::$app->getView();
        $this->assertEmpty($view->assetBundles);

        FontAwesomeAsset::register($view);

        $this->assertEquals(1, count($view->assetBundles));
        $this->assertArrayHasKey('webtoolsnz\\widgets\\FontAwesomeAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['webtoolsnz\\widgets\\FontAwesomeAsset'] instanceof AssetBundle);

        $content = $view->renderFile('@tests/views/layouts/raw.php');
        $this->assertStringContainsString('font-awesome.min.css', $content);
    }
}