# Radio Button Group

The `RadioButtonGroup` widget renders a list of radio toggle buttons in the form of bootstrap button group. See the [documentation](http://getbootstrap.com/components/#btn-groups)  for more styling information.

#### Basic usage with default settings:
~~~
use webtoolsnz\widgets\RadioButtonGroup;

$form->field($model, 'status_id')->widget(RadioButtonGroup::class, [
    'items' => [1 => 'Yes', 0 => 'No', 3 => 'Maybe']
]);
~~~
![screenshot](/docs/images/radio-button-group1.png?raw=true)


#### Customised active state (blue) and increased size:
~~~
use webtoolsnz\widgets\RadioButtonGroup;

$form->field($model, 'status_id')->widget(RadioButtonGroup::class, [
    'items' => [1 => 'Yes', 0 => 'No', 3 => 'Maybe'],
    'options' => ['class' => 'btn-group-lg']
    'itemOptions' => [
        'activeState' => 'btn active btn-primary'
    ]
 ]) ?>
~~~
![screenshot](/docs/images/radio-button-group2.png?raw=true)

#### Customised label states based on value:
Green for yes, red for no, orange for maybe.
~~~
use webtoolsnz\widgets\RadioButtonGroup;

$form->field($model, 'status_id')->widget(RadioButtonGroup::class, [
    'items' => [1 => 'Yes', 0 => 'No', 3 => 'Maybe'],
    'itemOptions' => [
        'buttons' => [
            0 => ['activeState' => 'btn active btn-danger'],
            3 => ['activeState' => 'btn active btn-warning'],
        ]
        ]
]);
~~~
![screenshot](/docs/images/radio-button-group3.png?raw=true)


#### Advanced itemOptions Example
This advanced example shows how to:
 - Control the visibility of other elements on the page using the `showElements` and `hideElements` options.
 - Disable specific buttons using the `disabled` option.
 - Define a custom JavaScript function to be executed when the a button is selected. 
~~~php
<?= $form->field($model, 'status_id')->widget(RadioButtonGroup::class, [
    'items' => [1 => 'Yes', 0 => 'No', 3 => 'Maybe'],
    'itemOptions' => [
        'buttons' => [
            0 => ['hideElements' => '.status-yes-info'],
            1 => [
                'showElements' => '.status-yes-info',
                'onSelect' => new JsExpression('function (e) {console.log("Yes was clicked!");}'),
            ],
            3 => ['disabled' => 'true'],
        ]
    ]
]); ?>

<div class="status-yes-info hidden">
    <p>I see you've chosen yes, are you sure thats right choice?</p>
</div>

~~~