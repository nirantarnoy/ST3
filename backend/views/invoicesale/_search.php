<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoicesaleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoicesale-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //echo $form->field($model, 'recid') ?>

    <?= $form->field($model, 'saleno') ?>

    <?= $form->field($model, 'saledate') ?>

    <?php //echo $form->field($model, 'customer') ?>

    <?php //echo $form->field($model, 'saleman') ?>

    <?php // echo $form->field($model, 'refno') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'shipdate') ?>

    <?php // echo $form->field($model, 'shipfrom') ?>

    <?php // echo $form->field($model, 'shipto') ?>

    <?php // echo $form->field($model, 'paymentterm') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'currencyrate') ?>

    <?php // echo $form->field($model, 'createdate') ?>

    <?php // echo $form->field($model, 'createby') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
