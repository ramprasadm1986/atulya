<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\CartAddress]].
 *
 * @see \common\models\CartAddress
 */
class CartAddressQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\CartAddress[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\CartAddress|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
