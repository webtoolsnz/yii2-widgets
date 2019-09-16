<?php
namespace tests;

use webtoolsnz\widgets\Wysihtml5;
use webtoolsnz\widgets\Wysihtml5Asset;
use Yii;
use tests\models\Payment;
use yii\helpers\VarDumper;
use yii\web\AssetBundle;


class Wysihtml5Test extends TestCase
{
    public function testRenderWithNameAndId()
    {
        $out = Wysihtml5::widget([
            'id' => 'test',
            'name' => 'test-widget-name',
        ]);

        $expected = '<textarea id="test" name="test-widget-name" rows="7" cols="95"></textarea>';
        $this->assertEquals($expected, $out);
    }

    public function testRenderWithModel()
    {
        $model = new Payment();
        $model->description = 'This is a description';

        $out = Wysihtml5::widget([
            'model' => $model,
            'attribute' => 'description',
        ]);

        $expected = '<textarea id="payment-description" name="Payment[description]" rows="7" cols="95">This is a description</textarea>';
        $this->assertEquals($expected, $out);
    }

    public function testRegisterClientScript()
    {
        $class = new \ReflectionClass('webtoolsnz\\widgets\\Wysihtml5');
        $method = $class->getMethod('registerClientScript');
        $method->setAccessible(true);
        $widget = Wysihtml5::begin(['id' => 'test', 'name' => 'test-widget-name']);
        $view = Yii::$app->getView();
        $widget->setView($view);
        $method->invoke($widget);

        $expected = <<<JS
jQuery(\'#test\').wysihtml5({\"image\":false});
JS;
        $this->assertStringContainsString($expected, VarDumper::dumpAsString($view->js));
    }

    public function testAssetRegister()
    {
        $view = Yii::$app->getView();
        $this->assertEmpty($view->assetBundles);

        Wysihtml5Asset::register($view);

        $this->assertEquals(4, count($view->assetBundles));
        $this->assertArrayHasKey('yii\\web\\JqueryAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['webtoolsnz\\widgets\\Wysihtml5Asset'] instanceof AssetBundle);

        $content = $view->renderFile('@tests/views/layouts/raw.php');

        $this->assertStringContainsString('bootstrap.css', $content);
        $this->assertStringContainsString('bootstrap3-wysihtml5.css', $content);
        $this->assertStringContainsString('bootstrap.js', $content);
        $this->assertStringContainsString('bootstrap3-wysihtml5.all.min.js', $content);
    }
}
