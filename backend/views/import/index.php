<?php
use yii\widgets\ActiveForm;
?>
<div class="setuser-form">

    <?php $form = ActiveForm::begin(['id'=>'myform','action'=>'index.php?r=import/upload','options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'upfile')->fileInput() ?>

    <div class="form-group">
        <input type="submit" class="btn btn-primary">
    </div>

    <?php ActiveForm::end(); ?>

</div>


