<?php

use yii\helpers\Html;
use \kartik\form\ActiveForm;
use kartik\number\NumberControl;

var_dump($model->getErrors());
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extra_cost')->widget(NumberControl::class, [
        'maskedInputOptions' => array_merge([
            'digits' => 4,
            'allowMinus' => false,
        ], Yii::$app->params['numericMask'])
    ]) ?>

    <?= $form->field($model, 'selling_price')->widget(NumberControl::class, [
        'maskedInputOptions' => array_merge([
            'digits' => 4,
            'allowMinus' => false,
        ], Yii::$app->params['numericMask'])
    ])  ?>

    <input id="form-token" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
