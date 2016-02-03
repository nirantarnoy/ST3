<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Invoicesale */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoicesale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'saleno')->textInput() ?>

    <?= $form->field($model, 'saledate')->textInput() ?>

    <?= $form->field($model, 'customer')->textInput() ?>

    <?= $form->field($model, 'saleman')->textInput() ?>

    <?= $form->field($model, 'refno')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'shipdate')->textInput() ?>

    <?= $form->field($model, 'shipfrom')->textInput() ?>

    <?= $form->field($model, 'shipto')->textInput() ?>

    <?= $form->field($model, 'paymentterm')->textInput() ?>

    <?= $form->field($model, 'currency')->textInput() ?>

    <?= $form->field($model, 'currencyrate')->textInput() ?>

    <?= $form->field($model, 'createdate')->textInput() ?>

    <?= $form->field($model, 'createby')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
