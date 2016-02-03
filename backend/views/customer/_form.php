<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">
   <?php $dummy = [];
   //print_r($secmodel);return;
   ?>
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <label class="control-label col-sm-3" for="inputSuccess3">Customer ID</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_id')->textInput()->label(false) ?>
    </div>
            <label class="control-label col-sm-3" for="inputSuccess3">Customer Name</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_Name')->textInput()->label(false) ?>
    </div>
            <label class="control-label col-sm-3" for="inputSuccess3">Nickname</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_Nickname')->textInput()->label(false) ?>
    </div>
            <label class="control-label col-sm-3" for="inputSuccess3">Description</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_Description')->textInput()->label(false) ?>
    </div>
            <label class="control-label col-sm-3" for="inputSuccess3">Phone</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_Phone')->textInput()->label(false) ?>
    </div>
            <label class="control-label col-sm-3" for="inputSuccess3">Fax</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_Fax')->textInput()->label(false) ?>
    </div>
            <label class="control-label col-sm-3" for="inputSuccess3">Email</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_Email')->textInput()->label(false) ?>
    </div>
            <label class="control-label col-sm-3" for="inputSuccess3">Website</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_Website')->textInput()->label(false) ?>
    </div>
          

            
        </div>
            <div class="col-lg-6">
                <label class="control-label col-sm-3" for="inputSuccess3">Address</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_Address')->textarea()->label(false) ?>
    </div>
         <label class="control-label col-sm-3" for="inputSuccess3">Province</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_Province')->dropDownList(
 ArrayHelper::map($province->find()->all(), 'ProvinceCode', 'ProvinceName')
              )->label(false) ?>
    </div>   
         <label class="control-label col-sm-3" for="inputSuccess3">Country</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_Country')->dropDownList(
 ArrayHelper::map($country->find()->all(), 'Cry_id', 'fullname')
              )->label(false) ?>
    </div>
         <label class="control-label col-sm-3" for="inputSuccess3">Contact Name</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_Contactname')->textInput()->label(false) ?>
    </div>
          <label class="control-label col-sm-3" for="inputSuccess3">Contact Phone</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_ContactPhone')->textInput()->label(false) ?>
    </div>
         <label class="control-label col-sm-3" for="inputSuccess3">Company</label>
    <div class="col-sm-9">
      <?= Html::dropDownList('com',$model->isNewRecord? null:$updatecom[0]['recid'],$xmodel, ['class'=>'form-control','id'=>'company',
//          ['options'=>[$updatecom[0]['recid'] =>['selected'=>true]]],
          'style'=>'margin-bottom: 15px;',
          'onchange'=>'
                $.post("index.php?r=customer/showsection&id='.'"+$(this).val(),function(data){
                    $("select#section").html(data);
                    //alert();
                });
          '
          ])
      ?>
      
    </div>
    <label class="control-label col-sm-3" for="inputSuccess3">Section</label>
    <div class="col-sm-9">
      <?= Html::dropDownList('section',$model->isNewRecord? null:$updatesec[0]['recid'],$secmodel,['prompt'=>'Select','class'=>'form-control','id'=>'section',
          'style'=>'margin-bottom: 15px;',
             'onchange'=>'
                $.post("index.php?r=customer/showdepartment&id='.'"+$(this).val(),function(data){
                    $("select#department").html(data);
                  //  alert();
                });
          '
      ])?>
    
    </div>
    <label class="control-label col-sm-3" for="inputSuccess3">Department</label>
    <div class="col-sm-9">
      <?= Html::dropDownList('department',$model->isNewRecord? null:$updatedep[0]['recid'],$depmodel,['prompt'=>'Select','class'=>'form-control','id'=>'department',
          'style'=>'margin-bottom: 15px;',
           'onchange'=>'
               //alert($(this).val());
                $.post("index.php?r=customer/showsale&id='.'"+$(this).val(),function(data){
                    $("select#customer-cus_customeras").html(data);
                  
                });
          '
       ])?>
    
    </div>
          <label class="control-label col-sm-3" for="inputSuccess3">Saleman</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'Cus_Customeras')->dropDownList(
    //  ArrayHelper::map($sale->find()->all(), 'Sale_Code','fullname')
      $model->isNewRecord? ArrayHelper::map($dummy, '',''): ArrayHelper::map($updatesale,'recid','salename')
              )->label(false) ?>
    
    </div>
         <label class="control-label col-sm-3" for="inputSuccess3"></label>
    <div class="col-sm-9">
       <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
          
        </div>
  
    </div>



    <?php //echo $form->field($model, 'ts_create')->textInput() ?>

    <?php //echo $form->field($model, 'ts_update')->textInput() ?>

    <?php //echo $form->field($model, 'ts_name')->textInput() ?>

    <?php //echo $form->field($model, 'IsDelete')->textInput() ?>

    
    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJs(
        '$(function(){
//            $("#company").change(function(){
//                    alert($(this).val());
//            });
        })
        ;'
);?>