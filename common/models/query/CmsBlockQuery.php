<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\CmsBlock]].
 *
 * @see \common\models\CmsBlock
 */
class CmsBlockQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\CmsBlock[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\CmsBlock|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
