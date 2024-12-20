<?php

use app\enums\Sex;
use app\enums\Species;
use yii\helpers\Html;
use kartik\detail\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Pet $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'responsive' => true,
        'hover' => true,
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'label' => Yii::t('app', 'Species'),
                'value' => Yii::t('app', Species::tryFrom($model->species)->name),
            ],
            'date_of_birth:date',
            [
                'label' => Yii::t('app', 'Sex'),
                'value' => Yii::t('app', Sex::tryFrom($model->sex)->name),
            ],
            'breed',
            'coat_color',
            'coat_type',
            [
                'label' => Yii::t('app', 'Weight'),
                'value' => Yii::$app->formatter->asDecimal($model->weight, 2),
            ],
            [
                'label' => Yii::t('app', 'Comments'),
                'format' => 'raw',
                'value' => nl2br(Html::encode($model->comments)),
            ],
            [
                'label' => Yii::t('app', 'Comments'),
                'format' => 'raw',
                'value' => nl2br(Html::encode($model->behavior_description)),
            ],
            'usual_objects_description',
            [
                'label' => Yii::t('app', 'Customer'),
                'value' => $model->customer->id . ' - ' . $model->customer->name,
            ],
        ],
    ]) ?>

</div>
