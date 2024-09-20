<?php

use app\models\Service;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ServiceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
Icon::map($this);
?>
<div class="service-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Service'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'description',
            [
                'attribute' => 'extra_cost',
                'format' => 'raw',
                'value' => function($model) {
                    return Yii::$app->formatter->asCurrency($model->extra_cost, null, [
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
                'template' => '{view} {update} {delete} {manage_components}',
                'buttons' => [
                    'manage_components' => function ($url, $model) {
                        return Html::a(
                            Icon::show('list-alt'),
                            Url::to(['service/manage-components', 'id' => $model->id]),
                            ['title' => Yii::t('app', 'Manage service components'), 'data-pjax' => '0']
                        );
                    },
                ],
            ],
        ],
    ]); ?>


</div>
