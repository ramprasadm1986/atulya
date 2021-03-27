<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_class_bank}}".
 *
 * @property int $id
 * @property int $code
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ClassBank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%_class_bank}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
     * @return \common\models\query\ClassBankQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ClassBankQuery(get_called_class());
    }
}
