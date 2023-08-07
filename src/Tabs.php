<?php
/**
 * @link https://gihub.com/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */

namespace webtoolsnz\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use webtoolsnz\widgets\TabsAsset;
use yii\base\InvalidConfigException;
use yii\helpers\Url;


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

    protected function prepareItems(&$items, $prefix = '')
    {
        if (!$this->hasActiveTab()) {
            $this->activateFirstVisibleTab();
        }

        foreach ($items as $n => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $options['id'] = ArrayHelper::getValue($options, 'id', $this->options['id'] . $prefix . '-tab' . $n);
            unset($items[$n]['options']['id']); // @see https://github.com/yiisoft/yii2-bootstrap4/issues/108#issuecomment-465219339

            if (!ArrayHelper::remove($item, 'visible', true)) {
                continue;
            }
            if (!array_key_exists('label', $item)) {
                throw new InvalidConfigException("The 'label' option is required.");
            }

            $selected = ArrayHelper::getValue($item, 'active', false);
            $disabled = ArrayHelper::getValue($item, 'disabled', false);
            $headerOptions = ArrayHelper::getValue($item, 'headerOptions', $this->headerOptions);
            if (isset($item['items'])) {
                $this->prepareItems($items[$n]['items'], '-dd' . $n);
                continue;
            } else {
                ArrayHelper::setValue($items[$n], 'options', $headerOptions);
                if (!isset($item['url'])) {
                    ArrayHelper::setValue($items[$n], 'url', '#' . $options['id']);
                    ArrayHelper::setValue($items[$n], 'linkOptions.data.toggle', 'tab');
                    ArrayHelper::setValue($items[$n], 'linkOptions.role', 'tab');
                    ArrayHelper::setValue($items[$n], 'linkOptions.aria-controls', $options['id']);
                    if (!$disabled) {
                        ArrayHelper::setValue($items[$n], 'linkOptions.aria-selected', $selected ? 'true' : 'false');
                    }
                } else {
                    ArrayHelper::setValue($items[$n], 'url', Url::to($item['url']));
                }
            }

            Html::addCssClass($options, ['widget' => 'tab-pane']);
            if ($selected) {
                Html::addCssClass($options, ['activate' => 'active']);
            }
            if ($this->renderTabContent) {
                $tag = ArrayHelper::remove($options, 'tag', 'div');
                $this->panes[] = Html::tag($tag, isset($item['content']) ? $item['content'] : '', $options);
            }
        }
    }
}
