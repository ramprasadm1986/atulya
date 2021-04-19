<?php

namespace frontend\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
use yii\helpers\Url;
/**
 * This is the model class for table "{{%catalog_category}}".
 *
 * @property int $id
 * @property int|null $root
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property string $image
 * @property int|null $include_in_menu
 * @property string|null $icon
 * @property int $icon_type
 * @property int $active
 * @property int $selected
 * @property int $disabled
 * @property int $readonly
 * @property int $visible
 * @property int $collapsed
 * @property int $movable_u
 * @property int $movable_d
 * @property int $movable_l
 * @property int $movable_r
 * @property int $removable
 * @property int $removable_all
 * @property int $child_allowed
 */
class CatalogCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%catalog_category}}';
    }
    
    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'root',
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'depthAttribute' => 'lvl',
            ],
        ];
    }

   
	public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
    
    /**
     * {@inheritdoc}
     * @return \frontend\models\query\CatalogCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\query\CatalogCategoryQuery(get_called_class());
    }
    
    
    private static function getTreeInline($categories, $left = 0, $right = null, $lvl = 1){

		$names=[];

		foreach ($categories as $index => $category) {
			
			if ($category->lft >= $left + 1 && (is_null($right) || $category->rgt <= $right) && $category->lvl == $lvl) {
				
				if($category->include_in_menu && $category->active){
					
					$node=[];
					
					
					$childs = self::getTreeInline($categories, $category->lft, $category->rgt, $category->lvl + 1);
					
					
						$node['url']=Url::to(['/category/'.$category->slug]);
						$node['itemsOptions']=['class'=>'dropdown-submenu'];
						$node['submenuOptions']=['class'=>'dropdown-menu'];
						$node['label']=$category->name;
						$node['items'] = $childs;
					
					$names[]= $node;
				}
			}
		}
		return $names;

	}


	public static function getFullTreeInline(){

		$roots = CatalogCategory::find()->roots()->addOrderBy('root, lft')->all();
		$numRoots = count($roots);
		$i = 0;
		$tree = [];
		$last =false;
		foreach ($roots as $root){
			
			if($root->include_in_menu && $root->active){
				$childs=self::getTreeInline($root->children()->all());
				
					$RootNode=[];
					$RootNode=[
						'url' => Url::to(['/category/'.$root->slug]),
						'label' => $root->name,
						'itemsOptions'=>['class'=>'dropdown-submenu'],
						'submenuOptions'=>['class'=>'dropdown-menu'],
						'items'=>$childs,
					];
					if(++$i === $numRoots) {
					$RootNode['options']=['class'=>'last'];
					}
					
					$tree [] = $RootNode;
				
				
				
				
			}
		}
		if(isset($tree[0]) && isset($tree[0]['items']))
		return $tree[0]['items'];
		else
		return [];
	}
    
    
     public  static function getCategoryFiletrs($id){
		
		$currentCategory = CatalogCategory::findOne(['id' => $id]);		
        
		$childs=self::getCategoryFiletrsInline($currentCategory->children()->all(),true,$currentCategory->lft,$currentCategory->rgt, $currentCategory->lvl + 1);
		
		
	
		return $childs;
	}
    
    
    private static function getCategoryFiletrsInline($categories,$currentOpen=null, $left = 0, $right = null, $lvl = 1){
		
		
		$names=[];

		foreach ($categories as $index => $category) {
		
			if ($category->lft >= $left + 1 && (is_null($right) || $category->rgt <= $right) && $category->lvl == $lvl) {
				
				
				if($category->active && $category->include_in_menu){
					
					$node=[];
					
					
					
					
						
						
					
						$node['url']=Url::toRoute(['/category/'.$category->slug]);
						$node['label']=$category->name;
						
						
						if($currentOpen == $category->id){
						$childs = self::getCategoryFiletrsInline($categories,true, $category->lft, $category->rgt, $category->lvl + 1);
						$node['items'] = $childs;
						}
						
						
						$names[$category->id]= $node;
				}
			}
		}
		return $names;
		
		
	}
}
