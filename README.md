# Widget Library for Yii2

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/webtoolsnz/yii2-widgets/master.svg?style=flat-square)](https://travis-ci.org/webtoolsnz/yii2-widgets)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/webtoolsnz/yii2-widgets.svg?style=flat-square)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/webtoolsnz/yii2-widgets.svg?style=flat-square)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets)

A collection of reusable widgets for Yii2.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```bash
$ composer require webtoolsnz/yii2-widgets
```


## Widgets Available

* [\webtoolsnz\widgets\Wysihtml5](docs/Wysihtml5.md)
    * A simple HTML5 WYSIWYG editor.
* [\webtoolsnz\widgets\RadioButtonGroup](docs/RadioButtonGroup.md)
    * A Slick alternative to radio buttons
* [\webtoolsnz\widgets\CurrencyInput](docs/CurrencyInput.md)
    * Input fields that supports localized currency codes.
* [\webtoolsnz\widgets\DatePicker](docs/DatePicker.md)
    * A Html5 Date Input shim, falls back to JUI DatePicker when no native widget available.
* [\webtoolsnz\widgets\DateRangePicker](docs/DateRangePicker.md)
    * A DateRangePicker.
* [\webtoolsnz\widgets\Tabs](docs/Tabs.md)
    * Extends the yii bootstrap tabs, allows linking to tabs.
* [\webtoolsnz\widgets\GooglePlaceSearch](docs/GooglePlaceSearch.md)
    * Easy to use input that implements google places search, also supports rendering a map.
* [\webtoolsnz\widgets\SelectOther](docs/SelectOther.md)
    * Simple select an option from predefined array or enter in something else.


## Asset Bundles

There are also some useful asset bundles available.

* \webtoolsnz\widgets\FontAwesomeAsset
* \webtoolsnz\widgets\ModernizrAsset
* \webtoolsnz\widgets\GooglePlaceSearchAsset


## Testing

`webtoolsnz/yii2-widgets` has a [PHPUnit](https://phpunit.de) test suite. To run the tests, run the following command from the project folder.

``` bash
$ composer test
```

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.