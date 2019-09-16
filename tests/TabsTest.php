<?php
namespace tests;

use Yii;
use Spatie\Snapshots\MatchesSnapshots;

class TabsTest extends TestCase
{
    use MatchesSnapshots;

    public function testRenderWithNameAndId()
    {
        $view = Yii::$app->getView();
        $content = $view->render('@tests/views/tabs');
        $actual = $view->render('@tests/views/layouts/main.php', ['content' => $content]);

        $this->assertMatchesSnapshot($actual);

    }
}
