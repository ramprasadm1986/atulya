<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\CatalogProductAttributesOptions]].
 *
 * @see \common\models\CatalogProductAttributesOptions
 */
class CatalogProductAttributesOptionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\CatalogProductAttributesOptions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\CatalogProductAttributesOptions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
