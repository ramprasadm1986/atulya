<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\ClassBank]].
 *
 * @see \common\models\ClassBank
 */
class ClassBankQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\ClassBank[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\ClassBank|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
