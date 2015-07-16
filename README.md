# Webtools Widget Library for Yii2

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/badges/quality-score.png?b=master&s=866121301cbff5e602e039acda72e8b6733a4938)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/badges/coverage.png?b=master&s=fe8e140620533f49eb9ed4af6e31a59c09b4b287)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/badges/build.png?b=master&s=c6f10868824a1c824fe7c275d6d1b78d492bfe84)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-widgets/build-status/master)

A collection of reusable widgets for Yii2.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Add the following to your `composer.json` file.

~~~
    "require" : {
        "webtoolsnz/yii2-widgets": "*"
    }, 
    "repositories": [
        {
            "type": "composer",
            "url": "https://packages.webtools.nz"
        }
    ]
~~~


## Widgets Available

* [\webtoolsnz\widgets\Wysihtml5](docs/Wysihtml5.md)
    * A simple HTML5 WYSIWYG editor.
* [\webtoolsnz\widgets\RadioButtonGroup](docs/RadioButtonGroup.md)
    * A Slick alternative to radio buttons
* [\webtoolsnz\widgets\CurrencyInput](docs/CurrencyInput.md)
    * Input fields that supports localized currency codes.
* [\webtoolsnz\widgets\DatePicker](docs/DatePicker.md)
    * A Html5 Date Input shim, falls back to JUI DatePicker when no native widget available.
* [\webtoolsnz\widgets\Tabs](docs/Tabs.md)
    * Extends the yii bootstrap tabs, allows linking to tabs.
* [\webtoolsnz\widgets\GooglePlaceSearch](docs/GooglePlaceSearch)
    * Easy to use input that implements google places search, also supports rendering a map.


## Asset Bundles

There are also some useful asset bundles available.

* \webtoolsnz\widgets\FontAwesomeAsset
* \webtoolsnz\widgets\ModernizrAsset
* \webtoolsnz\widgets\GooglePlaceSearchAsset
