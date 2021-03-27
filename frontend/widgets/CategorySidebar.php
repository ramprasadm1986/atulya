<?php

namespace frontend\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Menu as BaseMenu;

/**
 * Class Menu.
 */
class CategorySidebar extends BaseMenu
{
    /**
     * @var string
     */
    public $labelTemplate = '{label}';

    /**
     * @var string
     */
    public $linkTemplate = '<a href="{url}" {data} >{icon}{label}</a>{badge}';

    /**
     * @var string
     */
    public $submenuTemplate = "\n<ul>\n{items}\n</ul>\n";

    /**
     * @var bool
     */
    public $activateParents = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        Html::addCssClass($this->options, '');

        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        $renderedItem = parent::renderItem($item);
		
		
        if (isset($item['badge'])) {
            $badgeOptions = ArrayHelper::getValue($item, 'badgeOptions', []);
            Html::addCssClass($badgeOptions, 'label pull-right');
        }
		else {
            $badgeOptions = null;
        }
        $data=null;
        if(isset($item['data'])){
            
            foreach($item['data'] as $k=>$v)           
            $data.=$k.'="'.$v.'" ';
        }
        
        return strtr(
            $renderedItem,
            [
                '{icon}' => isset($item['icon']) ? $item['icon'] : '',
                '{data}'=>$data,
                '{badge}' => (
                    isset($item['badge'])
                        ? Html::tag('span',Html::tag('small', $item['badge'], $badgeOptions),['class'=>'pull-right-container'])
                        : ''
                    ) . (
                    (isset($item['items']) && count($item['items']) > 0)
                        ? (isset($item['options']['class'])? '<i class="fa fa-plus pull-right toggle-opener"></i>':'<i class="fa fa-minus pull-right toggle-opener"></i>')
                        : ''
                    ),
            ]
        );
    }
}
