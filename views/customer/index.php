<?php

use app\models\Customer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CustomerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Customers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Customer'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'phone',
            'email:email',
            'comments',
            [
                'attribute' => 'date_last_purchase',
                'format' => 'raw',
                'value' => fn ($model) => Yii::$app->formatter->asDate($model->date_last_purchase),
                'contentOptions' => ['style' => 'text-align: right;'],
            ],
            [
                'attribute' => 'avg_monthly_consumption',
                'format' => 'raw',
                'value' => function($model) {
                    return Yii::$app->formatter->asCurrency($model->avg_monthly_consumption, null, [
                        NumberFormatter::MAX_FRACTION_DIGITS => 4,
                        NumberFormatter::MIN_FRACTION_DIGITS => 2,
                    ]);
                },
                'contentOptions' => ['style' => 'text-align: right;'],
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Customer $model) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
