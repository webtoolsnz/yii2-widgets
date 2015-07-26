<?php
namespace tests;

use Yii;
use tests\models\Payment;
use yii\helpers\VarDumper;
use yii\web\AssetBundle;
use webtoolsnz\widgets\GooglePlaceSearch;
use webtoolsnz\widgets\GooglePlaceSearchAsset;

class GooglePlaceSearchTest extends TestCase
{
    public function testRenderWithNameAndId()
    {
        $out = GooglePlaceSearch::widget([
            'id' => 'test',
            'name' => 'test-widget-name',
        ]);

        $expected = '<input type="text" id="test" class="form-control" name="test-widget-name">';
        $this->assertEquals($expected, $out);
    }

    public function testRenderWithValueAndFormat()
    {
        $out = GooglePlaceSearch::widget([
            'id' => 'test',
            'name' => 'test-widget-name',
            'value' => '123 Some Street',
        ]);

        $expected = '<input type="text" id="test" class="form-control" name="test-widget-name" value="123 Some Street">';
        $this->assertEquals($expected, $out);
    }

    public function testRenderWithModel()
    {
        $model = new Payment();
        $model->address = '123 Some Street';

        $out = GooglePlaceSearch::widget([
            'model' => $model,
            'attribute' => 'address',
        ]);

        $expected = '<input type="text" id="payment-address" class="form-control" name="Payment[address]" value="123 Some Street">';
        $this->assertEquals($expected, $out);
    }

    public function testRegisterClientScript()
    {
        $class = new \ReflectionClass('webtoolsnz\\widgets\\GooglePlaceSearch');
        $method = $class->getMethod('registerClientScript');
        $method->setAccessible(true);
        $widget = GooglePlaceSearch::begin(['id' => 'test', 'name' => 'test-widget-name', 'country' => 'au']);
        $view = Yii::$app->getView();
        $widget->setView($view);
        $method->invoke($widget);

        $expected = <<<JS
jQuery(\'#test\').googlePlaceSearch({\"country\":\"au\",\"map\":{\"selector\":null},\"autocomplete\":{\"componentRestrictions\":{\"country\":\"au\"}}});
JS;
        $this->assertContains($expected, VarDumper::dumpAsString($view->js));
    }

    public function testRegisterClientScriptMap()
    {
        $class = new \ReflectionClass('webtoolsnz\\widgets\\GooglePlaceSearch');
        $method = $class->getMethod('registerClientScript');
        $method->setAccessible(true);
        $widget = GooglePlaceSearch::begin([
            'id' => 'test',
            'name' => 'test-widget-name',
            'country' => 'au',
            'map' => ['selector' => '#map']
        ]);
        $view = Yii::$app->getView();
        $widget->setView($view);
        $method->invoke($widget);

        $expected = <<<JS
jQuery(\'#test\').googlePlaceSearch({\"country\":\"au\",\"map\":{\"selector\":\"#map\"},\"autocomplete\":{\"componentRestrictions\":{\"country\":\"au\"}}});
JS;
        $this->assertContains($expected, VarDumper::dumpAsString($view->js));
    }

    public function testAssetRegister()
    {
        $view = Yii::$app->getView();
        $this->assertEmpty($view->assetBundles);

        GooglePlaceSearchAsset::register($view);

        $this->assertEquals(2, count($view->assetBundles));
        $this->assertArrayHasKey('yii\\web\\JqueryAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['webtoolsnz\\widgets\\GooglePlaceSearchAsset'] instanceof AssetBundle);

        $content = $view->renderFile('@tests/views/layouts/raw.php');

        $this->assertContains('jquery.js', $content);
        $this->assertContains('maps.googleapis.com/maps/api/js?libraries=places', $content);
        $this->assertContains('google-place-search.js', $content);
    }
}