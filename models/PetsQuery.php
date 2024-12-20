<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Pet]].
 *
 * @see Pet
 */
class PetsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Pet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Pet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
