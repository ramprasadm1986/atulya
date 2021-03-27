<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_class_tax}}".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 */
class ClassTax extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%_class_tax}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'code'], 'string', 'max' => 255],
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
            'code' => Yii::t('app', 'Code'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ClassTaxQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ClassTaxQuery(get_called_class());
    }
}
