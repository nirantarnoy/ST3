<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UdashboardSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="udashboard-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'recid') ?>

    <?= $form->field($model, 'invoiceno') ?>

    <?= $form->field($model, 'invoicedate') ?>

    <?= $form->field($model, 'invcurrency') ?>

    <?= $form->field($model, 'invcurrencyrate') ?>

    <?php // echo $form->field($model, 'customerid') ?>

    <?php // echo $form->field($model, 'createdate') ?>

    <?php // echo $form->field($model, 'disper') ?>

    <?php // echo $form->field($model, 'boxprc') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
