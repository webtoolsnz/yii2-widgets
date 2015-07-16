# CurrencyInput

The `CurrencyInput` widget renders an html5 number field, with the localized currency code addon

**Basic usage with default settings:**

```
<?= $form->field($model, 'cost')->widget(CurrencyInput::className()); ?>
```
![screenshot](/docs/images/CurrencyInput.png?raw=true)


**Customising input attributes:**
Since the input field is renders as a number field, you can apply those attributes, or any html attributes.

```
<?= $form->field($newRebate, 'rate')->widget(CurrencyInput::className(), ['options' => [
    'min' => 10,
    'max' => 100,
    'step' => 0.1,
    'class' => 'error',
]); ?>
```

**Setting Locality:**

The `CurrencyInput` determines is locality using the global formatter settings for your application you can
change this by updating the `formatter` component in your `confg/web.php` file

```
...
'components' => [
    'formatter' => [
        'currencyCode' => 'EUR',
    ],
]
...
```

`currencyCode` set to `EUR`:

![screenshot](/docs/images/CurrencyInput-EUR.png?raw=true)


`currencyCode` set to `JPY`:

![screenshot](/docs/images/CurrencyInput-JPY.png?raw=true)

