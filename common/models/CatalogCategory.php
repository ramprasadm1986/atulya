<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "CatalogCategory".
 *
 * @property int $id
 * @property int $root
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 * @property string $name
 * @property string $icon
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
class CatalogCategory extends \kartik\tree\models\Tree
{
    /**
     * {@inheritdoc}
     */
	 
	public $encodeNodeNames = false;
    
	public $allowNewRoots= false;
	
    public static function tableName()
    {
        return '{{%catalog_category}}';
    }
	
	/**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['include_in_menu','description','slug'], 'required'];
        $rules[] = ['slug', 'filter', 'filter' => [$this, 'sanitizeSlug']];
        $rules[] = [['slug'], 'unique'];
        $rules[] = [['slug'], 'match', 'pattern' => '/^[a-z0-9][a-z0-9-]+$/','message' => 'SLUG can only contain alphanumeric characters and dashes. All are in lower case.'];
        
        $rules[] = ['image', 'safe'];
        return $rules;
    }
    
    public function sanitizeSlug($value) {
        $value=strtolower($value);
        $value = preg_replace('!\s+!', ' ', $value);
        $value = str_replace(' ', '-', $value);
        $value = str_replace(',', '-', $value);         
        $value = preg_replace('/[^a-z0-9\-]/', '', $value); 
        $value = preg_replace('/-+/', '-', $value);
        
        
        return $value;
        
    }
	
	
	
	public static function JSON() {
        /** @var TreeQuery $query */
        $query = self::find()
            ->addOrderBy('root, lft')
            ->select(['id', 'active', 'name', 'selected', 'root', 'lft', 'rgt', 'lvl']);


        /** @var array|ActiveRecord[] $nodes */
        $nodes = $query->all();

        return $nodes;
    }
    
    
}
