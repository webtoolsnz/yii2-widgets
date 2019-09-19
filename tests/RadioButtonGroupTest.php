<?php
namespace tests;

use Spatie\Snapshots\Drivers\XmlDriver;
use Yii;
use tests\models\Payment;
use yii\helpers\VarDumper;
use yii\web\AssetBundle;
use webtoolsnz\widgets\RadioButtonGroup;
use webtoolsnz\widgets\RadioButtonGroupAsset;
use Spatie\Snapshots\MatchesSnapshots;
use yii\web\JsExpression;


class RadioButtonGroupTest extends TestCase
{
    use MatchesSnapshots;

    public function testRenderWithNameAndId()
    {
        $out = RadioButtonGroup::widget([
            'id' => 'test',
            'name' => 'test-widget-name',
            'items' => [1 => 'Yes', 0 => 'No'],
        ]);

        $this->assertMatchesSnapshot($out);
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
                'activeState' => 'btn btn-primary active',
                'buttons' => [
                    1 => [
                        'showElements' => '.show-if-yes',
                        'hideElements' => '.show-if-no',
                        'onSelect' => new JsExpression('function (e) {console.log(e);}')
                    ],
                    0 => [
                        'showElements' => '.show-if-no',
                        'hideElements' => '.show-if-yes'
                    ],
                    3 => ['disabled' => true],

                ]
            ],
            'inputOptions' => [
                'class' => 'test-class',
            ]
        ]);

        $this->assertMatchesSnapshot($out);
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

        $this->assertMatchesSnapshot($out);
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

        $this->assertMatchesSnapshot($out);
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

        $this->assertMatchesSnapshot(VarDumper::dumpAsString($view->js));
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

        $this->assertStringContainsString('bootstrap.css', $content);
        $this->assertStringContainsString('radio-button-group.css', $content);
        $this->assertStringContainsString('bootstrap.js', $content);
        $this->assertStringContainsString('radio-button-group.js', $content);
    }
}
