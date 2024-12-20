<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pet $model */
/** @var array $customerOptions */
/** @var array $speciesOptions */

$this->title = Yii::t('app', 'Create Pet');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'customerOptions' => $customerOptions,
        'speciesOptions' => $speciesOptions,
        'sexOptions' => $sexOptions,
    ]) ?>

</div>
