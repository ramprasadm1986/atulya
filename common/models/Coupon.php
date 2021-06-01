<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%coupon}}".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $start_on
 * @property string $expire_on
 * @property int $current_use
 * @property int $total_use
 * @property string|null $description
 * @property int $active
 * @property int $public
 * @property int $has_condition
 * @property string|null $filter_by
 * @property float|null $min_price
 * @property float|null $max_price
 * @property float $discount
 * @property string|null $products
 */
class Coupon extends \yii\db\ActiveRecord
{
    
    const CONDITION_TYPE_CATEGORY = 'category';
    const CONDITION_TYPE_PRODUCT = 'product';
    public $use_type;


    public function setDefaultValues()
    {
        
        if($this->isNewRecord){
            $this->active = 1;
            $this->public = 1;
            $this->has_condition = 0;
            $this->current_use = 0;
        }
        
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%coupon}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'start_on', 'expire_on', 'discount','discount_type'], 'required'],
            [['start_on', 'expire_on'], 'safe'],
            [['current_use', 'total_use', 'active', 'public', 'has_condition'], 'integer'],
            [['discount','total_rev','total_dis'], 'number'],
            [['products','categories'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['code', 'description','discount_type'], 'string', 'max' => 255],
            [['filter_by'], 'string', 'max' => 50],
            [['code'], 'unique'],
            [['code'], 'match', 'pattern' => '/^[A-Z0-9-]+$/','message' => 'Coupon Code can only contain alphanumeric characters and dashes. All are in upper case'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Coupon Code'),
            'start_on' => Yii::t('app', 'Start On'),
            'expire_on' => Yii::t('app', 'Expire On'),
            'current_use' => Yii::t('app', 'Current Use'),
            'total_use' => Yii::t('app', 'Total Use'),
            'description' => Yii::t('app', 'Description'),
            'active' => Yii::t('app', 'Active'),
            'public' => Yii::t('app', 'Allow Guest User'),
            'has_condition' => Yii::t('app', 'Has Condition'),
            'filter_by' => Yii::t('app', 'Filter By'),
            'discount_type' => Yii::t('app', 'Discount Type'),
            'discount' => Yii::t('app', 'Discount'),
            'products' => Yii::t('app', 'Products'),
            'categories' => Yii::t('app', 'Categories'),
            'total_rev' => Yii::t('app', 'Total Revenue Generated'),
            'total_dis' => Yii::t('app', 'Total Discount Given'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CouponQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CouponQuery(get_called_class());
    }
}
