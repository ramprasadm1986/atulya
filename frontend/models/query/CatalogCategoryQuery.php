<?php

namespace frontend\models\query;

use creocoder\nestedsets\NestedSetsQueryBehavior;

/**
 * This is the ActiveQuery class for [[\frontend\models\CatalogCategory]].
 *
 * @see \frontend\models\CatalogCategory
 */
class CatalogCategoryQuery extends \yii\db\ActiveQuery
{
    
    
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
    
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \frontend\models\CatalogCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\CatalogCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
