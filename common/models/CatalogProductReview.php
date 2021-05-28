<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%catalog_product_review}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $username
 * @property int $product_id
 * @property float $rating
 * @property string|null $comment
 * @property int $is_delete
 * @property string $created_at
 * @property string $update_at
 */
class CatalogProductReview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%catalog_product_review}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'username','rating','comment', 'product_id'], 'required'],
            [['user_id', 'product_id', 'is_delete'], 'integer'],
            [['rating'], 'number'],
            [['comment'], 'string'],
            [['created_at', 'update_at'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['user_id', 'product_id'], 'unique', 'targetAttribute' => ['user_id', 'product_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'username' => Yii::t('app', 'Username'),
            'product_id' => Yii::t('app', 'Product ID'),
            'rating' => Yii::t('app', 'Rating'),
            'comment' => Yii::t('app', 'Comment'),
            'is_delete' => Yii::t('app', 'Is Delete'),
            'created_at' => Yii::t('app', 'Created At'),
            'update_at' => Yii::t('app', 'Update At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CatalogProductReviewQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CatalogProductReviewQuery(get_called_class());
    }
}
