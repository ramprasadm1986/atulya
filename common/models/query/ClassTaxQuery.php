<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\ClassTax]].
 *
 * @see \common\models\ClassTax
 */
class ClassTaxQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\ClassTax[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\ClassTax|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
