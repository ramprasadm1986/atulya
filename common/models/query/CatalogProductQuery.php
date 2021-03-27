<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\CatalogProduct]].
 *
 * @see \common\models\CatalogProduct
 */
class CatalogProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\CatalogProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\CatalogProduct|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
