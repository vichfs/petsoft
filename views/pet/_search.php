<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PetSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'species') ?>

    <?= $form->field($model, 'date_of_birth') ?>

    <?= $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'breed') ?>

    <?php // echo $form->field($model, 'coat_color') ?>

    <?php // echo $form->field($model, 'coat_type') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'behavior_description') ?>

    <?php // echo $form->field($model, 'usual_objects_description') ?>

    <?php // echo $form->field($model, 'customer_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
