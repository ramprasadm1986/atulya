<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\TaxRate]].
 *
 * @see \common\models\TaxRate
 */
class TaxRateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\TaxRate[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\TaxRate|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
