<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $description
 * @property float|null $cost
 * @property float|null $packaging_cost
 * @property float|null $marketing_cost
 * @property float|null $selling_price
 * @property string|null $unit
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['cost', 'packaging_cost', 'marketing_cost', 'selling_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function() { return date('Y-m-d H:i:s'); },
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'description' => Yii::t('app', 'Description'),
            'cost' => Yii::t('app', 'Cost'),
            'packaging_cost' => Yii::t('app', 'Packaging Cost'),
            'marketing_cost' => Yii::t('app', 'Marketing Cost'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'unit' => Yii::t('app', 'Unit'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }
}
