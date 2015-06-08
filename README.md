# Webtools Widget Library for Yii2

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/badges/quality-score.png?b=master&s=866121301cbff5e602e039acda72e8b6733a4938)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/badges/coverage.png?b=master&s=fe8e140620533f49eb9ed4af6e31a59c09b4b287)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/badges/build.png?b=master&s=c6f10868824a1c824fe7c275d6d1b78d492bfe84)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/build-status/master)

A set of reusable widgets for Yii2.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Add the following to your `composer.json` file.

~~~
    "require" : {
        "webtoolsnz/yii2-widgets": "dev-master"
    }, 
    "repositories": [
        {
            "type": "composer",
            "url": "http://packages.webtools.nz"
        }
    ]
~~~


## Widgets Available


### Wysihtml5 Editor
A customizable HTML5 WYSIWYG editor.

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


### Radio Button Group

The `RadioButtonGroup` widget renders a list of radio toggle buttons in the form of bootstrap button group. See the [documentation](http://getbootstrap.com/components/#btn-groups)  for more styling information.

**Basic usage with default settings:**
~~~
use webtoolsnz\widgets\RadioButtonGroup;

$form->field($model, 'status_id')->widget(RadioButtonGroup::className(), [
	'items' => [1 => 'Yes', 0 => 'No', 3 => 'Maybe']
]);
~~~
![screenshot](https://bitbucket.org/webtoolsnz/yii2-widgets/raw/master/docs/images/radio-butto-group1.png)


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
![screenshot](https://bitbucket.org/webtoolsnz/yii2-widgets/raw/master/docs/images/radio-button-group2.png)

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
![screenshot](https://bitbucket.org/webtoolsnz/yii2-widgets/raw/master/docs/images/radio-button-group3.png)