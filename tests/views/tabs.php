<?php
/**
 * @var $this \yii\web\View
 */
use webtoolsnz\widgets\Tabs;
?>
<?= Tabs::widget([
    'items' => [
        'foo' => [
            'label'   => 'Foo',
            'content' => 'Foo Content',
            'active'  => true,
        ],
        'bar' => [
            'label' => 'Bar',
            'content' => 'Bar Content',
        ],
        [
            'label' => 'Baz',
            'content' => 'Baz Content'
        ]
    ]
]); ?>
