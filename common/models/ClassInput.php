<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_class_inputs}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class ClassInput extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%_class_inputs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['code', 'name'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ClassInputsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ClassInputsQuery(get_called_class());
    }
}
