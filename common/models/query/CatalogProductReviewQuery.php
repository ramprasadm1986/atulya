<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\CatalogProductReview]].
 *
 * @see \common\models\CatalogProductReview
 */
class CatalogProductReviewQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\CatalogProductReview[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\CatalogProductReview|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
