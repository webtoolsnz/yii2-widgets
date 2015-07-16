# Radio Button Group

The `RadioButtonGroup` widget renders a list of radio toggle buttons in the form of bootstrap button group. See the [documentation](http://getbootstrap.com/components/#btn-groups)  for more styling information.

**Basic usage with default settings:**
~~~
use webtoolsnz\widgets\RadioButtonGroup;

$form->field($model, 'status_id')->widget(RadioButtonGroup::className(), [
	'items' => [1 => 'Yes', 0 => 'No', 3 => 'Maybe']
]);
~~~
![screenshot](/docs/images/radio-button-group1.png?raw=true)


**Customised active state (blue) and increased size:**
~~~
use webtoolsnz\widgets\RadioButtonGroup;

$form->field($model, 'status_id')->widget(RadioButtonGroup::className(), [
	'items' => [1 => 'Yes', 0 => 'No', 3 => 'Maybe'],
	'options' => ['class' => 'btn-group-lg']
    'itemOptions' => [
    	'activeState' => 'btn active btn-primary'
    ]
 ]) ?>
~~~
![screenshot](/docs/images/radio-button-group2.png?raw=true)

**Customised label states based on value:**
Green for yes, red for no, orange for maybe.
~~~
use webtoolsnz\widgets\RadioButtonGroup;

$form->field($model, 'status_id')->widget(RadioButtonGroup::className(), [
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