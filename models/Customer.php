<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $comments
 * @property string|null $date_last_purchase
 * @property float|null $avg_monthly_consumption
 * @property string $created_at
 * @property string $updated_at
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['date_last_purchase', 'created_at', 'updated_at'], 'safe'],
            [['avg_monthly_consumption'], 'number'],
            [['name', 'email'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['phone'], 'string', 'max' => 13],
            [['comments'], 'string', 'max' => 2000],
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
            'name' => Yii::t('app', 'Name'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'comments' => Yii::t('app', 'Comments'),
            'date_last_purchase' => Yii::t('app', 'Last Purchase'),
            'avg_monthly_consumption' => Yii::t('app', 'Avg. Monthly Consumption'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        $dateLastPurchase = $this->date_last_purchase ?? '';
        if (!empty($dateLastPurchase)) {
            $mask = 'd/m/Y';
            if (substr(Yii::$app->language, 0, 2) === 'en') {
                $mask = 'm/d/Y';
            }
        }

        $dateLastPurchase = \DateTime::createFromFormat($mask, $dateLastPurchase);
        if (!$dateLastPurchase instanceof \DateTime) {
            throw new \Exception(Yii::t('app', 'The date is invalid'));
        }

        $this->date_last_purchase = $dateLastPurchase->format('Y-m-d');

        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     * @return CustomersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomersQuery(get_called_class());
    }
}
