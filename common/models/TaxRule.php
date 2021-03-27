<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tax_rule}}".
 *
 * @property int $id
 * @property string $tax_class_name
 * @property string|null $tax_rate_ids
 * @property string $created_at
 * @property string $updated_at
 */
class TaxRule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tax_rule}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tax_class_name','tax_rate_ids'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['tax_class_name'], 'string', 'max' => 255],
            [['tax_class_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tax_class_name' => 'Tax Class Name',
            'tax_rate_ids' => 'Tax Rate Identifires',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TaxRuleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaxRuleQuery(get_called_class());
    }
}
