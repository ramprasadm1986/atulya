<?php

namespace common\models;

use Yii;

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
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%catalog_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['root', 'lft', 'rgt', 'lvl', 'include_in_menu', 'icon_type', 'active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all', 'child_allowed'], 'integer'],
            [['lft', 'rgt', 'lvl', 'name', 'description', 'slug', 'image'], 'required'],
            [['description', 'image'], 'string'],
            [['name'], 'string', 'max' => 60],
            [['slug', 'icon'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['slug', 'filter', 'filter' => [$this, 'sanitizeSlug']],
            [['slug'], 'match', 'pattern' => '/^[a-z0-9][a-z0-9-]+$/','message' => 'SLUG can only contain alphanumeric characters and dashes. All are in lower case.'],
        ];
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'root' => Yii::t('app', 'Root'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'lvl' => Yii::t('app', 'Lvl'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'slug' => Yii::t('app', 'Slug'),
            'image' => Yii::t('app', 'Image'),
            'include_in_menu' => Yii::t('app', 'Include In Menu'),
            'icon' => Yii::t('app', 'Icon'),
            'icon_type' => Yii::t('app', 'Icon Type'),
            'active' => Yii::t('app', 'Active'),
            'selected' => Yii::t('app', 'Selected'),
            'disabled' => Yii::t('app', 'Disabled'),
            'readonly' => Yii::t('app', 'Readonly'),
            'visible' => Yii::t('app', 'Visible'),
            'collapsed' => Yii::t('app', 'Collapsed'),
            'movable_u' => Yii::t('app', 'Movable U'),
            'movable_d' => Yii::t('app', 'Movable D'),
            'movable_l' => Yii::t('app', 'Movable L'),
            'movable_r' => Yii::t('app', 'Movable R'),
            'removable' => Yii::t('app', 'Removable'),
            'removable_all' => Yii::t('app', 'Removable All'),
            'child_allowed' => Yii::t('app', 'Child Allowed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CategoryQuery(get_called_class());
    }
}
