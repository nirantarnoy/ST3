<?php

use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\web\Session;

$session = new Session();
$session->open();
?>

<?php
$customer = new \backend\models\Customer();
$currency = new \backend\models\Currency();
$saledata = new \backend\models\Saledata();
$country = new \backend\models\Country();
?>
 <?php    yii\widgets\ActiveForm::begin(['id'=>'form-1','action'=>'index.php?r=openreport/execreport'])?>
<div class="panel panel-success">
 
    <div class="panel-heading">เลือกเงื่อนไขรายงาน</div>
    <div class="panel-body">
        <div class="row"> 
            <?php if(isset($_SESSION['module'])&& $_SESSION['module']==2 or $_SESSION['module']==3 ):?>
            <div class="col-md-2">
                 <label class="control-label col-sm-3" for="inputSuccess3">ปี</label>
            </div>
            <div class="col-md-10">
                  <div class="col-sm-9">
                    <select class="form-control" name='yyyy'>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                    </select>
                </div>
            </div>
            
               <?php endif;?>
        </div>
        <?php if(isset($_SESSION['module'])&& $_SESSION['module']==3 ):?>
        <div class="row">
            <div class="col-md-2">

            <label class="control-label col-sm-12" for="inputSuccess3">ถึงปี</label>
            </div>
            <div class="col-md-10">
                 <div class="col-sm-9">
                    <select class="form-control" name='yyyyy'>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                    </select>
                </div>
            </div>
        </div>
        <?php endif;?>
        <div class="row">
            <?php if(isset($_SESSION['module'])&& $_SESSION['module']!=2 && $_SESSION['module']!=3 ):?>
            <div class="col-md-2">
                 <label class="control-label col-sm-3" for="inputSuccess3">เดือน</label>
            </div>
            <div class="col-md-10">
                  <div class="col-sm-9">
               
                    <select class="form-control">
                        <option value="1">Jan</option>
                        <option value="2">Feb</option>
                        <option value="3">Mar</option>
                        <option value="4">Apr</option>
                        <option value="5">May</option>
                        <option value="6">Jun</option>
                        <option value="7">Jul</option>
                        <option value="8">Aug</option>
                        <option value="9">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>

                    </select>
                  </div>
                 
            </div>
         <?php endif;?>
        </div>
       <?php if(isset($_SESSION['module'])&& $_SESSION['module']!=2 ):?>
        <div class="row">
            <div class="col-md-2">
                 <label class="control-label col-sm-3" for="inputSuccess3">Sale</label>
            </div>
            <div class="col-sm-10">
                 
               
                <div class="col-sm-9">
                    <?= yii\bootstrap\Html::dropDownList('sale_id',null,  ArrayHelper::map($saledata->find()->all(), 'Sale_Code', 'Sale_Name'),['prompt'=>'*', 'class'=>'form-control']  );?>
                </div>
                
            </div>
        </div>
            <?php endif;?>
    </div>
    <div class="panel-footer">
       
        <button type="submit" class="btn btn-primary">พิมพ์รายงาน</button>
       
    </div>
    
</div>
 <?php yii\widgets\ActiveForm::end()?>
