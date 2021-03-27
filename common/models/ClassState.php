<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_class_states}}".
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 * @property string $country_code
 * @property string|null $iso2
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ClassCity[] $classCities
 * @property ClassCountry $country
 */
class ClassState extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%_class_states}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'country_id', 'country_code'], 'required'],
            [['country_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'iso2'], 'string', 'max' => 255],
            [['country_code'], 'string', 'max' => 2],
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
            'country_id' => 'Country ID',
            'country_code' => 'Country Code',
            'iso2' => 'Iso2',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[ClassCities]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ClassCityQuery
     */
    public function getClassCities()
    {
        return $this->hasMany(ClassCity::className(), ['state_id' => 'id']);
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
     * @return \common\models\query\ClassStatesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ClassStatesQuery(get_called_class());
    }
}
