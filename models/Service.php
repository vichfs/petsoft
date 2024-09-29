<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $description
 * @property float|null $extra_cost
 * @property float|null $selling_price
 * @property string $created_at
 * @property string $updated_at
 */
class Service extends \yii\db\ActiveRecord
{
    public $productIds;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['extra_cost', 'selling_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            ['productIds', 'each', 'rule' => ['integer']],
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
            'extra_cost' => Yii::t('app', 'Extra Cost'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ServicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServicesQuery(get_called_class());
    }

    public function getServiceProducts()
    {
        return $this->hasMany(ServiceProduct::class, ['service_id' => 'id']);
    }

    public function getProducts() {
        return $this->hasMany(Product::class, ['id' => 'product_id'])
            ->via('serviceProducts');
    }

    public function afterFind()
    {
        $this->productIds = $this->getProducts()->select('id')->column();
        parent::afterFind();
    }

    public function beforeDelete()
    {
        ServiceProduct::deleteAll(['service_id' => $this->id]);
        return true;
    }
}
