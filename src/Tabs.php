<?php
/**
 * @link https://gihub.com/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


class Tabs extends \yii\bootstrap4\Tabs
{
    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'wt-tabs');

        $this->setItemIds();
    }

    public function run()
    {
        TabsAsset::register($this->getView());
        
        if (!$this->hasActiveTab() && !empty($this->items)) {
            reset($this->items);
            $this->items[key($this->items)]['active'] = true;
        }

        return parent::run();
    }

    public function setItemIds()
    {
        foreach($this->items as $id => &$item) {

            if (!isset($item['options'])) {
                $item['options'] = [];
            }

            if (is_numeric($id)) {
                $item['options']['id'] = ArrayHelper::getValue($item['options'], 'id',  $this->options['id'] . '-tab' . $id);
            }  else {
                $item['options']['id'] = ArrayHelper::getValue($item['options'], 'id', $id);
            }
        }
    }
}
