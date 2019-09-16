<?php

namespace tests;

use Yii;
use webtoolsnz\widgets\BootBoxAsset;
use yii\web\AssetBundle;

class BootBoxAssetTest extends TestCase
{
    public function testRegister()
    {
        $view = Yii::$app->getView();
        $this->assertEmpty($view->assetBundles);

        BootBoxAsset::register($view);

        $this->assertEquals(2, count($view->assetBundles));
        $this->assertArrayHasKey('webtoolsnz\\widgets\\BootBoxAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['webtoolsnz\\widgets\\BootBoxAsset'] instanceof AssetBundle);

        $content = $view->renderFile('@tests/views/layouts/raw.php');
        $this->assertStringContainsString('bootbox.js', $content);
    }
}