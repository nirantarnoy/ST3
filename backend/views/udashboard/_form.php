<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Udashboard */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="udashboard-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invoiceno')->textInput() ?>

    <?= $form->field($model, 'invoicedate')->textInput() ?>

    <?= $form->field($model, 'invcurrency')->textInput() ?>

    <?= $form->field($model, 'invcurrencyrate')->textInput() ?>

    <?= $form->field($model, 'customerid')->textInput() ?>

    <?= $form->field($model, 'createdate')->textInput() ?>

    <?= $form->field($model, 'disper')->textInput() ?>

    <?= $form->field($model, 'boxprc')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
