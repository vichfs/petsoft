<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'description',
            'unit',
            [
                'attribute' => 'cost',
                'format' => 'raw',
                'value' => function($model) {
                    return Yii::$app->formatter->asCurrency($model->cost, null, [
                        NumberFormatter::MAX_FRACTION_DIGITS => 4,
                        NumberFormatter::MIN_FRACTION_DIGITS => 2,
                    ]);
                },
                'contentOptions' => ['style' => 'text-align: right;'],
            ],
            [
                'attribute' => 'packaging_cost',
                'format' => 'raw',
                'value' => function($model) {
                    return Yii::$app->formatter->asCurrency($model->packaging_cost, null, [
                        NumberFormatter::MAX_FRACTION_DIGITS => 4,
                        NumberFormatter::MIN_FRACTION_DIGITS => 2,
                    ]);
                },
                'contentOptions' => ['style' => 'text-align: right;'],
            ],
            [
                'attribute' => 'marketing_cost',
                'format' => 'raw',
                'value' => function($model) {
                    return Yii::$app->formatter->asCurrency($model->marketing_cost, null, [
                        NumberFormatter::MAX_FRACTION_DIGITS => 4,
                        NumberFormatter::MIN_FRACTION_DIGITS => 2,
                    ]);
                },
                'contentOptions' => ['style' => 'text-align: right;'],
            ],
            [
                'attribute' => 'selling_price',
                'format' => 'raw',
                'value' => function($model) {
                    return Yii::$app->formatter->asCurrency($model->selling_price, null, [
                        NumberFormatter::MAX_FRACTION_DIGITS => 4,
                        NumberFormatter::MIN_FRACTION_DIGITS => 2,
                    ]);
                },
                'contentOptions' => ['style' => 'text-align: right;'],
            ],
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
