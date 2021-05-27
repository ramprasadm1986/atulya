<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%catalog_product}}".
 *
 * @property int $id
 * @property string|null $type
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property string $sku
 * @property string $slug
 * @property string|null $meta_title
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string|null $base_image
 * @property string|null $gallery_images
 * @property float|null $length
 * @property float|null $width
 * @property float|null $height
 * @property string|null $length_class
 * @property float|null $weight
 * @property string|null $weight_class
 * @property string|null $tax_type
 * @property int|null $tax_type_id
 * @property string|null $tax_class
 * @property int|null $tax_rule_id
 * @property float|null $price
 * @property int|null $is_special_price
 * @property float|null $special_price
 * @property string|null $special_price_from
 * @property string|null $special_price_to
 * @property string|null $categories
 * @property string|null $related
 * @property string|null $up_sell
 * @property string|null $cross_sell
 * @property int|null $is_featured
 * @property int|null $is_trending
 * @property int|null $is_bestseller
 * @property int|null $is_new
 * @property string|null $new_from
 * @property string|null $new_to
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CartItem[] $cartItems
 * @property CatalogProductAttribute[] $catalogProductAttributes
 * @property CatalogProductVariation[] $catalogProductVariations 
 * @property OrderItem[] $orderItems
 */
class CatalogProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%catalog_product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'short_description', 'description', 'sku', 'slug'], 'required'],
            [['short_description', 'description', 'meta_title', 'meta_keywords', 'meta_description', 'base_image', 'gallery_images','size_chart', 'categories', 'related', 'up_sell', 'cross_sell'], 'string'],
            [['length', 'width', 'height', 'weight', 'price', 'special_price'], 'number'],
            [['tax_type_id', 'tax_rule_id', 'is_special_price', 'is_featured', 'is_trending', 'is_bestseller', 'is_new', 'status'], 'integer'],
            [['special_price_from', 'special_price_to', 'new_from', 'new_to', 'created_at', 'updated_at'], 'safe'],
            [['type', 'length_class', 'weight_class'], 'string', 'max' => 10],
            [['name', 'sku', 'slug', 'tax_type', 'tax_class'], 'string', 'max' => 255],
            [['tax_type','tax_rule_id'],'required','on'=>'reqtax'],
            [['sku'], 'unique'],
            ['slug', 'filter', 'filter' => [$this, 'sanitizeSlug']],
            [['slug'], 'match', 'pattern' => '/^[a-z0-9][a-z0-9-]+$/','message' => 'SLUG can only contain alphanumeric characters and dashes. All are in lower case and must start with characters.'],
            [['sku'], 'match', 'pattern' => '/^[a-zA-Z0-9][a-zA-Z0-9-_\.]{1,255}$/','message' => 'SKU can only contain alphanumeric characters, underscores and dashes.']
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
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'sku' => Yii::t('app', 'Sku'),
            'slug' => Yii::t('app', 'Slug'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'base_image' => Yii::t('app', 'Base Image'),
            'gallery_images' => Yii::t('app', 'Gallery Images'),
            'size_chart' => Yii::t('app', 'Size Chart'),
            'length' => Yii::t('app', 'Length'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'length_class' => Yii::t('app', 'Length Class'),
            'weight' => Yii::t('app', 'Weight'),
            'weight_class' => Yii::t('app', 'Weight Class'),
            'tax_type' => Yii::t('app', 'Tax Type'),
            'tax_type_id' => Yii::t('app', 'Tax Type ID'),
            'tax_class' => Yii::t('app', 'Tax Class'),
            'tax_rule_id' => Yii::t('app', 'Tax Rule ID'),
            'price' => Yii::t('app', 'Price'),
            'is_special_price' => Yii::t('app', 'Is Special Price'),
            'special_price' => Yii::t('app', 'Special Price'),
            'special_price_from' => Yii::t('app', 'Special Price From'),
            'special_price_to' => Yii::t('app', 'Special Price To'),
            'categories' => Yii::t('app', 'Categories'),
            'related' => Yii::t('app', 'Related'),
            'up_sell' => Yii::t('app', 'Up Sell'),
            'cross_sell' => Yii::t('app', 'Cross Sell'),
            'is_featured' => Yii::t('app', 'Is Featured'),
            'is_trending' => Yii::t('app', 'Is Trending'),
            'is_bestseller' => Yii::t('app', 'Is Bestseller'),
            'is_new' => Yii::t('app', 'Is New'),
            'new_from' => Yii::t('app', 'New From'),
            'new_to' => Yii::t('app', 'New To'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[CatalogProductAttributes]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CatalogProductAttributeQuery
     */
    public function getCatalogProductAttributes()
    {
        return $this->hasMany(CatalogProductAttribute::className(), ['product_id' => 'id']);
    }
    
     public function getCPAttributes()
    {
        return $this->hasMany(CatalogProductAttribute::className(), ['product_id' => 'id'])->andOnCondition(['status' => 1]);
    }
    
    
    /** 
    * Gets query for [[CatalogProductVariations]]. 
    * 
    * @return \yii\db\ActiveQuery|\common\models\query\CatalogProductVariationQuery 
    */ 
   public function getCatalogProductVariations() 
   { 
       return $this->hasMany(CatalogProductVariation::className(), ['product_id' => 'id']); 
   } 
   
   public function getVariationsMin() 
   { 
       return $this->hasOne(CatalogProductVariation::className(), ['product_id' => 'id'])->min("price"); 
   }
   
   public function getVariationPrice($variant=null) 
   { 
       if(Yii::$app->session->has('variant')) {
        $variant = Yii::$app->session->get('variant');
       }   
       return $this->hasOne(CatalogProductVariation::className(), ['product_id' => 'id'])->andOnCondition(['combination' => $variant]);; 
   }
   
   public function getVariationsMax() 
   { 
       return $this->hasOne(CatalogProductVariation::className(), ['product_id' => 'id'])->max("price"); 
   }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CatalogProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CatalogProductQuery(get_called_class());
    }
    
    public static function getProducts(){
        
        $data= self::find()->where(['status'=>1])->asArray()->all();
        
        $fdata=[];
        
        foreach($data as $d){
            $d['value']=$d['name'];
            $fdata[]=$d;
        }
        
        return $fdata;
    }
}
