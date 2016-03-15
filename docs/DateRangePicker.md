# DateRangePicker

The `DateRangePicker` widget renders an datepicker input. Currently requires start and end inputs on page

**Basic usage with default settings:**

```
<?= $form->field($model, 'start')->widget(\webtoolsnz\widgets\DatePicker::className()) ?>
<?= $form->field($model, 'end')->widget(\webtoolsnz\widgets\DatePicker::className()) ?>
<?= \webtoolsnz\widgets\DateRangePicker::widget([
    'start_attribute' => 'start',
    'end_attribute' => 'end',
    'model' => $model,
]) ?>
```

**Customising Options:**

You can set any DateRangePicker supported options using the `clientOptions` setting as shown below.
For more information view the project details http://www.daterangepicker.com/#options or https://github.com/dangrossman/bootstrap-daterangepicker

```
<?= $form->field($model, 'date')->widget(DatePicker::className(), [
    'options' => [
        'class' => 'form-control',
    ],
    'clientOptions' => [
        'maxDate' => '2000-01-01',
        'minDate' => '1900-01-01',
        'autoApply' => true,
        'linkedCalendars' => false,
    ]
]); ?>
```
