# Wysihtml5 Editor
A simple HTML5 WYSIWYG editor.

**Using on an active form:**
~~~
use webtoolsnz\widgets\Wysihtml5;

// Basic usage
$form->field($model, 'detail')->widget(Wysihtml5::className());

// With customised toolbar and size
$form->field($model, 'detail')->widget(Wysihtml5::className(), [
	'options' => ['rows' => 10, 'cols' => 20],
	'clientOptions' => [
		'font-styles'=> false,
    	'emphasis' => false,
    	'link' => false,
        'color' => true,
	]
]);
~~~

You can pass any options available into the `clientOptions` property, [See the documentation for more details](https://github.com/Waxolunist/bootstrap3-wysihtml5-bower).

