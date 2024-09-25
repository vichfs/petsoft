<?php

namespace app\models;

use Yii;

class ServiceProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_products';
    }

     /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'service_id' => Yii::t('app', 'Service ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'amount_used' => Yii::t('app', 'Amount Used'),
        ];
    }

    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
