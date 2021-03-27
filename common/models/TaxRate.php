<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tax_rate}}".
 *
 * @property int    $id
 * @property string $tax_name
 * @property float  $rate
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $zip
 * @property string $created_at
 * @property string $updated_at
 */
class TaxRate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tax_rate}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country','state','tax_identifire','tax_name', 'rate'], 'required'],
            [['rate'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['tax_identifire','tax_name', 'city', 'zip'], 'string', 'max' => 255],
            [['tax_identifire'], 'unique'],
            [['country', 'state'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tax_identifire'=> 'Tax Iidentifire',
            'tax_name' => 'Name',
            'rate' => 'Rate',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'zip' => 'Zip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    /**
     * Gets query for [[stateName]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ClassStatesQuery
     */
    public function getStateName()
    {
        return $this->hasOne(ClassState::className(), ['iso2' => 'state','country_code'=>'country']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TaxRateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaxRateQuery(get_called_class());
    }
}
