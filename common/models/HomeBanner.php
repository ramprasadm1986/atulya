<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%home_banner}}".
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string|null $link_to
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int $status
 * @property string $created_at
 * @property string $update_at
 */
class HomeBanner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%home_banner}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'image'], 'required'],
            [['image', 'link_to'], 'string'],
            [['start_date', 'end_date', 'created_at', 'update_at'], 'safe'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'image' => Yii::t('app', 'Image'),
            'link_to' => Yii::t('app', 'Link To'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'update_at' => Yii::t('app', 'Update At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\HomeBannerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\HomeBannerQuery(get_called_class());
    }
}
