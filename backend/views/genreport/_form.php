<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Genreport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="genreport-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Sale_Code')->textInput() ?>

    <?= $form->field($model, 'Sale_Name')->textInput() ?>

    <?= $form->field($model, 'Sale_Lastname')->textInput() ?>

    <?= $form->field($model, 'Sale_Address')->textInput() ?>

    <?= $form->field($model, 'Sale_Province')->textInput() ?>

    <?= $form->field($model, 'Sale_Contact')->textInput() ?>

    <?= $form->field($model, 'Sale_Email')->textInput() ?>

    <?= $form->field($model, 'Sale_Branch')->textInput() ?>

    <?= $form->field($model, 'Sale_Description')->textInput() ?>

    <?= $form->field($model, 'ts_create')->textInput() ?>

    <?= $form->field($model, 'ts_update')->textInput() ?>

    <?= $form->field($model, 'ts_name')->textInput() ?>

    <?= $form->field($model, 'IsDelete')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
