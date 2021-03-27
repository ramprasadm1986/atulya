<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\ClassProduct]].
 *
 * @see \common\models\ClassProduct
 */
class ClassProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\ClassProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\ClassProduct|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
