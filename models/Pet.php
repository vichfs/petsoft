<?php

namespace app\models;

use app\helpers\H;
use Yii;

/**
 * This is the model class for table "pets".
 *
 * @property int $id
 * @property string $name
 * @property string $species
 * @property string|null $date_of_birth
 * @property string|null $sex
 * @property string|null $breed
 * @property string|null $coat_color
 * @property string|null $coat_type
 * @property float|null $weight
 * @property string|null $comments
 * @property string|null $behavior_description
 * @property string|null $usual_objects_description
 * @property int $customer_id
 *
 * @property Customer $customer
 */
class Pet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'species', 'customer_id'], 'required'],
            [['date_of_birth'], 'safe'],
            [['weight'], 'number'],
            [['customer_id'], 'default', 'value' => null],
            [['customer_id'], 'integer'],
            [['name', 'breed', 'coat_color', 'coat_type', 'usual_objects_description'], 'string', 'max' => 255],
            [['species', 'sex'], 'string', 'max' => 1],
            ['species', 'in', 'range' => ['C', 'F']],
            ['sex', 'in', 'range' => ['F', 'M']],
            [['comments', 'behavior_description'], 'string', 'max' => 2000],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'id']],
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
            'species' => Yii::t('app', 'Species'),
            'date_of_birth' => Yii::t('app', 'Date of Birth'),
            'sex' => Yii::t('app', 'Sex'),
            'breed' => Yii::t('app', 'Breed'),
            'coat_color' => Yii::t('app', 'Coat Color'),
            'coat_type' => Yii::t('app', 'Coat Type'),
            'weight' => Yii::t('app', 'Weight'),
            'comments' => Yii::t('app', 'Comments'),
            'behavior_description' => Yii::t('app', 'Behavior Description'),
            'usual_objects_description' => Yii::t('app', 'Usual Objects'),
            'customer_id' => Yii::t('app', 'Customer'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        $dateOfBirth = H::date2obj($this->date_of_birth ?? '');

        if (!$dateOfBirth) {
            throw new \Exception(Yii::t('app', 'The date is invalid'));
        }

        $this->date_of_birth = $dateOfBirth->format('Y-m-d');

        return parent::beforeSave($insert);
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery|CustomersQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }

    /**
     * {@inheritdoc}
     * @return PetsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PetsQuery(get_called_class());
    }
}
