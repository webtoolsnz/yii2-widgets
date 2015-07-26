<?php
namespace tests;

use Yii;
use webtoolsnz\widgets\DatePickerAsset;
use webtoolsnz\widgets\DatePicker;
use tests\models\Payment;
use yii\helpers\VarDumper;
use yii\web\AssetBundle;

class DatePickerTest extends TestCase
{
    public function testRenderWithNameAndId()
    {
        $out = DatePicker::widget([
            'id' => 'test',
            'name' => 'test-widget-name',
            'value' => '2015-01-01',
        ]);

        $expected = '<input type="date" id="test" class="progressive-datepicker" name="test-widget-name" value="2015-01-01" formattedValue="Jan 1, 2015">';
        $this->assertEquals($expected, $out);
    }

    public function testRenderWithValueAndFormat()
    {
        $out = DatePicker::widget([
            'id' => 'test',
            'name' => 'test-widget-name',
            'dateFormat' => 'php:d/m/Y',
            'value' => '2015-01-01',
        ]);

        $expected = '<input type="date" id="test" class="progressive-datepicker" name="test-widget-name" value="2015-01-01" formattedValue="01/01/2015">';
        $this->assertEquals($expected, $out);
    }

    public function testRenderWithModel()
    {
        $model = new Payment();
        $model->created_at = '2015-07-02';

        $out = DatePicker::widget([
            'model' => $model,
            'attribute' => 'created_at',
        ]);

        $expected = '<input type="date" id="payment-created_at" class="progressive-datepicker" name="Payment[created_at]" value="2015-07-02" formattedValue="Jul 2, 2015">';
        $this->assertEquals($expected, $out);
    }

    public function testRegisterClientScript()
    {
        $class = new \ReflectionClass('webtoolsnz\\widgets\\DatePicker');
        $method = $class->getMethod('registerClientScript');
        $method->setAccessible(true);
        $widget = DatePicker::begin(['id' => 'test', 'name' => 'test-widget-name']);
        $view = Yii::$app->getView();
        $widget->setView($view);
        $method->invoke($widget);

        $expected = <<<JS
jQuery(\'#test\').progressiveDatePicker(\'\', {\"dateFormat\":\"M d, yy\"});
JS;
        $this->assertContains($expected, VarDumper::dumpAsString($view->js));
    }

    public function testAssetRegister()
    {
        $view = Yii::$app->getView();
        $this->assertEmpty($view->assetBundles);

        DatePickerAsset::register($view);

        $this->assertEquals(4, count($view->assetBundles));
        $this->assertArrayHasKey('yii\\web\\JqueryAsset', $view->assetBundles);
        $this->assertArrayHasKey('yii\\jui\\JuiAsset', $view->assetBundles);
        $this->assertArrayHasKey('webtoolsnz\\widgets\\ModernizrAsset', $view->assetBundles);

        $this->assertTrue($view->assetBundles['webtoolsnz\\widgets\\ModernizrAsset'] instanceof AssetBundle);
        $this->assertTrue($view->assetBundles['webtoolsnz\\widgets\\DatePickerAsset'] instanceof AssetBundle);

        $content = $view->renderFile('@tests/views/layouts/raw.php');

        $this->assertContains('jquery.js', $content);
        $this->assertContains('jquery-ui.js', $content);
        $this->assertContains('modernizr.js', $content);
        $this->assertContains('progressive-datepicker.js', $content);

    }
}