<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cms_page}}".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $meta_title
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string $content
 * @property int $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class CmsPage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cms_page}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'content'], 'required'],
            [['meta_description', 'content'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug', 'meta_title', 'meta_keywords'], 'string', 'max' => 255],
            ['slug', 'filter', 'filter' => [$this, 'sanitizeSlug']],
            [['slug'], 'unique'],
            [['slug'], 'match', 'pattern' => '/^[a-z0-9][a-z0-9-]+$/','message' => 'SLUG can only contain alphanumeric characters and dashes. All are in lower case.'],
        ];
    }
    
    public function sanitizeSlug($value) {
        $value=strtolower($value);
        $value = preg_replace('!\s+!', ' ', $value);
        $value = str_replace(' ', '-', $value);
        $value = str_replace(',', '-', $value);         
        $value = preg_replace('/[^a-z0-9\-]/', '', $value); 
        $value = preg_replace('/-+/', '-', $value);
        
        
        return $value;
        
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CmsPageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CmsPageQuery(get_called_class());
    }
}
