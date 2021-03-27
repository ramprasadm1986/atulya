<?php

namespace backend\components;

use yii\base\Component;

class SidebarMenu extends Component {

    const REGISTER = 'register';

    private $items = [];

    public function init() {
        $this->trigger(self::REGISTER);
        return parent::init();
    }

    public function setItem($item) {
        if (!isset($item['sortOrder']))
            $item['sortOrder'] = 1000;
        
        $id=$item['id'];
        
        if(isset($this->items[$id]))
        {
            $subitems=$this->items[$id]['items'];           
            $subitems=array_merge($subitems,$item['items']);
            
            usort($subitems, function ($a, $b) {
            
                if ($a['sortOrder'] == $b['sortOrder']) {
                    return 0;
                } else
                if ($a['sortOrder'] < $b['sortOrder']) {
                    return - 1;
                } else {
                    return 1;
                }
            });
            $this->items[$id]['items']=$subitems;
        }
        else
            $this->items[$id] = $item;
    }

    public function getItems() {
        $this->sortItems();
        return $this->items;
    }

    /**
     * Sorts the item attribute by sortOrder
     */
    private function sortItems() {
        usort($this->items, function ($a, $b) {
            
            if ($a['sortOrder'] == $b['sortOrder']) {
                return 0;
            } else
            if ($a['sortOrder'] < $b['sortOrder']) {
                return - 1;
            } else {
                return 1;
            }
        });
    }
    
  
}

?>