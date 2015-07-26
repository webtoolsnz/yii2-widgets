<?php
namespace tests;

use Yii;

class TabsTest extends TestCase
{
    public function testRenderWithNameAndId()
    {
        $view = Yii::$app->getView();
        $content = $view->render('@tests/views/tabs');
        $actual = $view->render('@tests/views/layouts/main.php', ['content' => $content]);
        $expected = file_get_contents(__DIR__.'/data/tabs-content.bin');
        $this->assertEquals($expected, $actual);
    }
}
