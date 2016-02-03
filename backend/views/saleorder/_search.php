<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SaleorderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="saleorder-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

   <div class="form-inline">
     <div class="input-group">
               <?= $form->field($model, 'globalSearch')->textInput(['placeholder'=>'Search'])->label(false) ?> 
              <span class="input-group">
                   <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-flat']) ?>
              <!-- <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button> -->
              </span>
            </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
