<?php
namespace tests;

use Yii;
use tests\models\Payment;
use yii\helpers\VarDumper;
use yii\web\AssetBundle;
use webtoolsnz\widgets\RadioButtonGroup;
use webtoolsnz\widgets\RadioButtonGroupAsset;

class RadioButtonGroupTest extends TestCase
{
    public function testRenderWithNameAndId()
    {
        $out = RadioButtonGroup::widget([
            'id' => 'test',
            'name' => 'test-widget-name',
            'items' => [1 => 'Yes', 0 => 'No'],
        ]);

        $expected = '<div class="radio-button-group"><div id="radio_button_test" class="btn-group" data-field="#test"><button type="button" class="btn btn-default" data-value="1">Yes</button><button type="button" class="active btn btn-success" data-value="0">No</button></div></div><input type="hidden" id="test" name="test-widget-name">';
        $this->assertEquals($expected, $out);
    }

    public function testRenderWithOptions()
    {
        $out = RadioButtonGroup::widget([
            'id' => 'test',
            'name' => 'test-widget-name',
            'items' => [1 => 'Yes', 0 => 'No', 3 => 'Maybe'],
            'options' => ['class' => 'foobar'],
            'itemOptions' => [
                'defaultState' => 'btn btn-primary',
                'activeState' => 'btn btn-primary active'
            ],
            'inputOptions' => [
                'class' => 'test-class',
            ]
        ]);

        $expected = '<div class="radio-button-group foobar"><div id="radio_button_test" class="btn-group" data-field="#test"><button type="button" class="btn btn-primary" data-value="1">Yes</button><button type="button" class="btn btn-primary active" data-value="0">No</button><button type="button" class="btn btn-primary" data-value="3">Maybe</button></div></div><input type="hidden" id="test" class="test-class" name="test-widget-name">';
        $this->assertEquals($expected, $out);
    }

    public function testRenderWithButtonOptions()
    {
        $out = RadioButtonGroup::widget([
            'name' => 'test-widget-name',
            'items' => [1 => 'Yes', 0 => 'No', 3 => 'Maybe'],
            'value' => 1,
            'itemOptions' => [
                'buttons' => [
                    1 => ['defaultState' => 'btn btn-success', 'activeState' => 'btn btn-success active'],
                    0 => ['defaultState' => 'btn btn-danger', 'activeState' => 'btn btn-danger active'],
                    3 => ['defaultState' => 'btn btn-warning', 'activeState' => 'btn btn-warning active'],
                ]
            ],
        ]);

        $expected = '<div class="radio-button-group"><div id="radio_button_w0" class="btn-group" data-field="#w0"><button type="button" class="btn btn-success active" data-value="1">Yes</button><button type="button" class="btn btn-danger" data-value="0">No</button><button type="button" class="btn btn-warning" data-value="3">Maybe</button></div></div><input type="hidden" id="w0" name="test-widget-name" value="1">';
        $this->assertEquals($expected, $out);
    }

    public function testRenderWithModel()
    {
        $model = new Payment();
        $model->status_id = Payment::STATUS_INACTIVE;

        $out = RadioButtonGroup::widget([
            'model' => $model,
            'attribute' => 'status_id',
            'items' => Payment::$statuses
        ]);

        $expected = '<div class="radio-button-group"><div id="radio_button_payment-status_id" class="btn-group" data-field="#payment-status_id"><button type="button" class="btn btn-default" data-value="10">Active</button><button type="button" class="active btn btn-success" data-value="20">Inactive</button></div></div><input type="hidden" id="payment-status_id" name="Payment[status_id]" value="20">';
        $this->assertEquals($expected, $out);
    }

    public function testRegisterClientScript()
    {
        $class = new \ReflectionClass('webtoolsnz\\widgets\\RadioButtonGroup');
        $method = $class->getMethod('registerClientScript');
        $method->setAccessible(true);
        $widget = RadioButtonGroup::begin(['name' => 'test-widget-name', 'items' => Payment::$statuses]);
        $view = Yii::$app->getView();
        $widget->setView($view);
        $method->invoke($widget);

        $expected = <<<JS
jQuery(\'#radio_button_w1\').radioButtonGroup({\"activeState\":\"active btn btn-success\",\"defaultState\":\"btn btn-default\",\"buttons\":[]});
JS;
        $this->assertContains($expected, VarDumper::dumpAsString($view->js));
    }

    public function testAssetRegister()
    {
        $view = Yii::$app->getView();
        $this->assertEmpty($view->assetBundles);

        RadioButtonGroupAsset::register($view);

        $this->assertEquals(4, count($view->assetBundles));
        $this->assertArrayHasKey('yii\\web\\JqueryAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['webtoolsnz\\widgets\\RadioButtonGroupAsset'] instanceof AssetBundle);

        $content = $view->renderFile('@tests/views/layouts/raw.php');

        $this->assertContains('bootstrap.css', $content);
        $this->assertContains('radio-button-group.css', $content);
        $this->assertContains('bootstrap.js', $content);
        $this->assertContains('radio-button-group.js', $content);
    }
}
