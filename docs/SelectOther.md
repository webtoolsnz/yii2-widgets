# SelectOther

The `SelectOther` widget renders an simple text input for free text. The javascript adds a select box which allows the user to optionally select from predefined options

**Basic usage with default settings:**

```
<?= $form->field($model, 'employment')->widget(SelectOther::className(), ['items' => ['Full-time', 'Part-time']]); ?>
```
