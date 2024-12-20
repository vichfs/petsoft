<?php

use kartik\date\DatePicker;
use kartik\icons\Icon;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use yii\helpers\Html;
use \kartik\form\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pet $model */
/** @var array $customerOptions */
/** @var array $speciesOptions */
/** @var array $sexOptions */
/** @var yii\widgets\ActiveForm $form */

Icon::map($this);

?>

<div class="pet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->widget(Select2::class, [
        'data' => $customerOptions,
        'options' => ['placeholder' => Yii::t('app', 'Select a customer…')],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'species')->widget(Select2::class, [
        'data' => $speciesOptions,
        'options' => ['placeholder' => Yii::t('app', 'Select the species…')],
        'hideSearch' => true,
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'date_of_birth')->widget(DatePicker::class, [
        'language' => Yii::$app->language, // Set language based on application configuration
    ]) ?>

    <?= $form->field($model, 'sex')->widget(Select2::class, [
        'data' => $sexOptions,
        'options' => ['placeholder' => Yii::t('app', 'Select the sex…')],
        'hideSearch' => true,
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'breed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coat_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coat_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->widget(NumberControl::class, [
        'maskedInputOptions' => array_merge([
            'digits' => 2,
            'allowMinus' => false,
        ], Yii::$app->params['numericMask'])
    ]) ?>

    <?= $form->field($model, 'comments')->textArea([
        'maxlength' => true,
        'rows' => 4,
    ]) ?>

    <?= $form->field($model, 'behavior_description')->textArea([
        'maxlength' => true,
        'rows' => 4,
    ]) ?>

    <?= $form->field($model, 'usual_objects_description')->textInput(['maxlength' => true]) ?>

    <input id="form-token" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
