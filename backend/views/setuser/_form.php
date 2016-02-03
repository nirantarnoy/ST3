<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Setuser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setuser-form">
    <?php $ugroup = new backend\models\Usergroup();?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fname')->textInput() ?>

    <?= $form->field($model, 'lname')->textInput() ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'groupid')->dropDownList(
 ArrayHelper::map($ugroup->find()->all(), 'recid', 'groupname')
            ) ?>

   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
