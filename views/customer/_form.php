<?php

use kartik\date\DatePicker;
use kartik\icons\Icon;
use kartik\number\NumberControl;
use yii\helpers\Html;
use \kartik\form\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Customer $model */
/** @var yii\widgets\ActiveForm $form */

Icon::map($this);

if ($model->hasErrors()) {
    var_dump($model->getErrors());
}

?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comments')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_last_purchase')->widget(DatePicker::class, [
        'language' => Yii::$app->language, // Set language based on application configuration
    ]) ?>

    <?= $form->field($model, 'avg_monthly_consumption')->widget(NumberControl::class, [
        'maskedInputOptions' => array_merge([
            'digits' => 2,
            'allowMinus' => false,
        ], Yii::$app->params['numericMask'])
    ]) ?>

    <input id="form-token" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
