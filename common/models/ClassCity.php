<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_class_cities}}".
 *
 * @property int $id
 * @property string $name
 * @property int $state_id
 * @property string $state_code
 * @property int $country_id
 * @property string $country_code
 * @property float $latitude
 * @property float $longitude
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ClassState $state
 * @property ClassCountry $country
 */
class ClassCity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%_class_cities}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'state_id', 'state_code', 'country_id', 'country_code', 'latitude', 'longitude'], 'required'],
            [['state_id', 'country_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'state_code'], 'string', 'max' => 255],
            [['country_code'], 'string', 'max' => 2],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClassState::className(), 'targetAttribute' => ['state_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClassCountry::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'state_id' => 'State ID',
            'state_code' => 'State Code',
            'country_id' => 'Country ID',
            'country_code' => 'Country Code',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[State]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ClassStateQuery
     */
    public function getState()
    {
        return $this->hasOne(ClassState::className(), ['id' => 'state_id']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ClassCountryQuery
     */
    public function getCountry()
    {
        return $this->hasOne(ClassCountry::className(), ['id' => 'country_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ClassCitiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ClassCitiesQuery(get_called_class());
    }
}
