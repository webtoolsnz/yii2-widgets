<?php
namespace tests;

use webtoolsnz\widgets\CurrencyInput;
use tests\models\Payment;

class CurrencyInputTest extends TestCase
{
    public function testRenderWithNameAndId()
    {
        $out = CurrencyInput::widget([
            'id' => 'test',
            'name' => 'test-widget-name',
            'value' => '500',
        ]);

        $expected = '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text">$</span></div><input type="number" id="test" class="form-control" name="test-widget-name" value="500" step="0.01" min="0"></div>';
        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testRenderWithOptions()
    {
        $out = CurrencyInput::widget([
            'id' => 'test',
            'name' => 'test-widget-name',
            'value' => '100',
            'options' => [
                'step' => 10,
                'class' => 'foo',
                'min' => 20,
            ]
        ]);

        $expected = '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text">$</span></div><input type="number" id="test" class="foo form-control" name="test-widget-name" value="100" step="10" min="20"></div>';
        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testRenderWithModel()
    {
        $model = new Payment();
        $model->amount = 250.25;

        $out = CurrencyInput::widget([
            'model' => $model,
            'attribute' => 'amount',
        ]);

        $expected = '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text">$</span></div><input type="number" id="payment-amount" class="form-control" name="Payment[amount]" value="250.25" step="0.01" min="0"></div>';

        $this->assertEqualsWithoutLE($expected, $out);
    }



}