<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_class_countries}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $iso3
 * @property string|null $iso2
 * @property string|null $phonecode
 * @property string|null $currency
 * @property string|null $emoji
 * @property string|null $emojiU
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ClassCity[] $classCities
 * @property ClassState[] $classStates
 */
class ClassCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%_class_countries}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['iso3'], 'string', 'max' => 3],
            [['iso2'], 'string', 'max' => 2],
            [['phonecode', 'currency'], 'string', 'max' => 255],
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
            'iso3' => 'Iso3',
            'iso2' => 'Iso2',
            'phonecode' => 'Phonecode',
            'currency' => 'Currency',
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
        return $this->hasMany(ClassCity::className(), ['country_id' => 'id']);
    }

    /**
     * Gets query for [[ClassStates]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ClassStateQuery
     */
    public function getClassStates()
    {
        return $this->hasMany(ClassState::className(), ['country_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ClassCountriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ClassCountriesQuery(get_called_class());
    }
}
