<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cms_block}}".
 *
 * @property int $id
 * @property string $title
 * @property string $identifier
 * @property int $is_system
 * @property string|null $content
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class CmsBlock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cms_block}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'identifier'], 'required'],
            [['is_system', 'status'], 'integer'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'identifier'], 'string', 'max' => 255],
            [['identifier'], 'unique'],
            [['identifier'], 'match', 'pattern' => '/^[a-z][a-z0-9-]+$/','message' => 'IDENTIFIER can only contain alphanumeric characters and dashes. All are in lower case and must start with characters'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'identifier' => Yii::t('app', 'Identifier'),
            'is_system' => Yii::t('app', 'Is System'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CmsBlockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CmsBlockQuery(get_called_class());
    }
}
