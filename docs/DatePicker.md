# DatePicker

The `DatePicker` widget renders an html5 date input field where possible, otherwise it will fall back to using the JUI datepicker.

**Basic usage with default settings:**

```
<?= $form->field($model, 'date')->widget(DatePicker::className()); ?>
```

**Customising Options:**

You can set any JUI supported options using the `clientOptions` setting as shown below,
you can also set the input fields attributes using the `options` setting.

```
<?= $form->field($model, 'date')->widget(DatePicker::className(), [
    'options' => [
        'class' => 'form-control',
    ],
    'clientOptions' => [
        'changeYear' => true,
        'changeMonth' => true,
    ]
]); ?>
```

**Adding Calendar Icon:**
You can wrap any addons around the field using input template.

```
<?= $form->field($model, 'date', [
    'inputTemplate' => '<div class="input-group"><div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>{input}</div>',
])->widget(DatePicker::className(), [
    'options' => ['class' => 'form-control'],
]); ?>
```

**Setting Render Format:**

The `DatePicker` derives the rendering format using the global formatter settings for your application, you can
change this by updating the `formatter` component in your `confg/web.php` file.

For seemeless integration when saving and rendering formatted dates from a model it is recommended that you use the
[webtoolsnz\behaviors\DateFormatBehavior](https://github.com/webtoolsnz/yii2-behaviors/blob/master/src/DateFormatBehavior.php)

```
...
'components' => [
    'formatter' => [
        'dateFormat' => 'dd/MM/yyyy',
    ],
]
...
```
