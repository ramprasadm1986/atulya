<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_class_modules}}".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $is_system
 * @property int $is_active
 */
class ClassModules extends \yii\db\ActiveRecord
{
    
    const IS_SYSTEM = 1;
    const IS_OTHER = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%_class_modules}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['is_system', 'is_active'], 'integer'],
            [['name', 'code'], 'string', 'max' => 255],
            [['code'], 'unique'],
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
            'code' => 'Code',
            'is_system' => 'Is System',
            'is_active' => 'Is Active',
        ];
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByModule($ModuleCode)
    {
        return static::findOne(['code' => $ModuleCode]);
    }
    
    
    /**
     * {@inheritdoc}
     * @return \common\models\query\ClassModulesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ClassModulesQuery(get_called_class());
    }
}
