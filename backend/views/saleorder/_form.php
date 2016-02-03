<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\grid\GridView;
use yii\web\Session;
use yii\widgets\LinkPager;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$session = new Session();
$session->open();

/* @var $this yii\web\View */
/* @var $model backend\models\Saleorder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="saleorder-form">
    <?php
        $customer = new \backend\models\Customer();
        $currency = new \backend\models\Currency();
        $sale = new \backend\models\Saledata();
        $country = new \backend\models\Country();
        $saleorline = new \backend\models\Saleorderline();
        
     //   Yii::$app->params['uploadPath'] = realpath(Yii::$app->basePath) . '/uploads/icon/';
       Yii::$app->params['uploadPath'] ='../../uploads/icon/';
     //   echo  Yii::$app->params['uploadPath'];
    ?>
    <?php $form = ActiveForm::begin(['id'=>'myform','options'=>['class'=>'form-horizontal','enctype'=>'multipart/form-data']]); ?>
   <div class="salenoid"  <?php echo "id=$model->recid"; ?>></div>
   <?php if(!empty($session->getFlash('msgsuccess'))):?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?=$session->getFlash('msgsuccess');?>
        </div>
        <?php endif;?>
   <?php if(!empty($session->getFlash('msgerror'))):?>
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?=$session->getFlash('msgerror');?>
        </div>
        <?php endif;?>
     <div class="box">
            <div class="box-header">
                 <div class="box-title">
                        SalesOrder Header
                    </div>
                <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                    </ul>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                
                
    <div class="row">
       
        <div class="col-md-6">
          
   
    <label class="control-label col-sm-3" for="inputSuccess3">Sale no</label>
    <div class="col-sm-9">
     <?= $form->field($model, 'saleno')->textInput()->label(false) ?>
        <?php if(!empty($session->getFlash('modelerror'))):?>
        <div class="alert alert-error">
            <?=$session->getFlash('modelerror');?>
        </div>
        <?php endif;?>
    </div>
  
    <label class="control-label col-sm-3" for="inputSuccess3">Order date</label>
    <div class="col-sm-9 form-group">
    
           <?php
               // echo '<label>Sales order date</label>';
                echo DatePicker::widget([
                    'name' => 'saledate',
                    'model' => $model,
                    'attribute' => 'saledate',
                    'value' => date('d-m-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Select sale date ...','class'=>'form-control'],
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'autoclose'=>true,
                        'todayHighlight' => true
                    ]
                ]);
                ?>
    </div>
   
    <label class="control-label col-sm-3" for="inputSuccess3">Customer</label>
    <div class="col-sm-9">

        
        <?= $form->field($model, 'customer')->widget(Select2::classname(), [
    'data' => ArrayHelper::map($customer->find()->all(),"Cus_id",  function($data){return $data->getFullname() ;}),
    'language' => 'en',
    'options' => ['placeholder' => 'Select customer......',
         'onchange'=>' //alert("niran");
                  $.post("index.php?r=saleorder/showlist&id='.'"+$(this).val(),function(data){
                      $("select#saleorder-saleman").html(data);
                     
                      });
                  $.post("index.php?r=saleorder/showlist2&id='.'"+$(this).val(),function(data){
                       $("select#saleorder-shipto").html(data);
                      
                      });
                      $.post("index.php?r=saleorder/showlist3&id='.'"+$(this).val(),function(data){
                       $("select#saleorder-shipfrom").html(data);
                      
                      });
     '
        ],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label(false)?>
        
    </div>

   
    <label class="control-label col-sm-3" for="inputSuccess3">Sales</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'saleman')->dropDownList(
              
 //ArrayHelper::map($sale->find()->all(),"Sale_Code","Sale_Name"),['prompt'=>'Select sale......','disabled'=>'disabled']
 ArrayHelper::map($sale->find()->all(),"Sale_Code","Fullname"),['prompt'=>'Select sale......','disabled'=>'disabled']
              )->label(false) ?>
    </div>

    <label class="control-label col-sm-3" for="inputSuccess3">From</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'shipfrom')->dropDownList(
              
 ArrayHelper::map($country->find()->all(),"Cry_id","Cry_nameTH"),['prompt'=>'Select country......',]
              )->label(false) ?>
    </div>

    <label class="control-label col-sm-3" for="inputSuccess3">To</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'shipto')->textInput()->dropDownList(
              
 ArrayHelper::map($country->find()->all(),"Cry_id","Cry_nameTH"),['prompt'=>'Select country......','disabled'=>'disabled']
              )->label(false) ?>
    </div>

    <label class="control-label col-sm-3" for="inputSuccess3">Description</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'description')->textarea()->label(false) ?>
    </div>
    <label class="control-label col-sm-3" for="inputSuccess3">Summary</label>
    <div class="col-sm-9">
        <div class="row" style="background-color: gray">
            <div class="col-sm-4">
                <div style="color: white;text-align: right;">
                    <h5>
                          <?php echo number_format($saleorline->ordersum($model->recid),0).' '.'PCS.';?>
                    </h5>
                  
                </div>
                
            </div>
             <?php if(isset($model->currencyname->currencycode)):?>
            <?php  if($model->currencyname->currencycode != "THB"):?>
                    <div class="col-sm-4">
                         <div style="color: white;text-align: right;">
                    <h5>
                <?php echo number_format($saleorline->usdsum($model->recid),2).' '.$model->currencyname->currencycode;?>
                    </h5>
                         </div>
               </div>
            <?php //elseif($model->currencyname->currencycode == "THB"):?>
            <div class="col-sm-4">
                 <div style="color: white;text-align: right;">
                    <h5>
                 <?php 
                  if($model->currencyname->currencycode != "THB"){
                      echo number_format($saleorline->Usdsum($model->recid)*$model->currencyrate).' '.'THB';
                  }else{
                      echo number_format($saleorline->thbsum($model->recid),2).' '.'THB';
                  }
                 
                 ?>
                    </h5>
                 </div>
            </div>
    <?php endif;?>
            <?php endif;?>
        </div>
      
       
    
    </div>
        </div>
        <div class="col-md-6">
            
             <label class="control-label col-sm-3" for="inputSuccess3">Ref No.</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'refno')->textInput()->label(false) ?>
    </div>
             <label class="control-label col-sm-3" for="inputSuccess3">Shipment date</label>
    <div class="col-sm-9 form-group">
       
                      <?php
               
                echo DatePicker::widget([
                    'name' => 'shipdate',
                    'model' => $model, 
                    'attribute' => 'shipdate' ,
                    'value' => date('dd-mm-yyyy', strtotime('+2 days')),
                    'type'=>  DatePicker::TYPE_COMPONENT_PREPEND,
                   
//                    'value' =>function($data){
//                    $shdate = strtotime($data->shipdate);
//                     return '122' ;
//                    }, //date('d-m-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Select shipment date ...'],
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'autoclose'=>true,
                        'todayHighlight' => true
                       
                    ]
                ]);
                ?>
    </div>
                    <label class="control-label col-sm-3" for="inputSuccess3">Payment term.</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'paymentterm')->textInput()->label(false) ?>
    </div>
                    
       <label class="control-label col-sm-3" for="inputSuccess3">Currency</label>
    <div class="col-sm-9">
        <div class="col-sm-9">
            <div style="margin-left: -15px;">
             <?= $form->field($model, 'currency')->dropDownList(
              
 ArrayHelper::map($currency->find()->all(),"recid","currencycode"),['id'=>'currency','prompt'=>'Select currency......']
              )->label(false) ?>
            </div>
        </div>
          <div class="col-sm-3">
              <img id="imgcur" src="<?php echo isset($model->currency)? Yii::$app->params['uploadPath'].$model->currencyicon->icon:'';?>" style="width: 30px;" >
<!--             <img id="imgcur" src="<?php //echo isset($model->currency)? Yii::$app->params['uploadPath'].$model->currencyicon->icon:'';?>" style="width: 30px;" >-->
        </div>
     
    </div>
      
<label class="control-label col-sm-3" for="inputSuccess3">Currency rate</label>
    <div class="col-sm-9">
      <?= $form->field($model, 'currencyrate')->textInput(['id'=>'currate'])->label(false) ?>
    </div>

 <label class="control-label col-sm-3" for="inputSuccess3"></label>
    <div class="col-sm-9">
              <div style="margin-left: 0px;">
             <h5> Last update: <?= $model->createdate?> </h5>
        <h5> Update by: <?= $model->createby?></h5>
        </div>
    </div>

        
   <label class="control-label col-sm-3" for="inputSuccess3"></label>
    <div class="col-sm-9">
              <div style="margin-left: 0px;">
             <?= $form->field($model, 'upfile')->fileInput(['class'=>'btn btn-default']) ?>
        </div>
           
     <div style="margin-left: -15px;">
        
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'btnsubmit']) ?>
        <?= Html::button('Remove detail',['value'=>  \yii\helpers\Url::to(['index.php?r=saleorder/removeall']),'class'=>'btn btn-danger','id'=>'removeupload'])?>
       <?php if(!empty($session->getFlash('msgerror'))):?>
         <a class="btn btn-info" href="index.php?r=nonepartnumber">Show none part</a>
          <?php //echo Html::button('Show none part',['value'=>  \yii\helpers\Url::to(['index.php?r=nonepartnumber']),'class'=>'btn btn-info','id'=>'shownonepart'])?>
         <?php endif;?>
          <a class="btn btn-info" href="index.php?r=nonepartnumber">Show none part</a>
           
           
 </div>
    </div>
   
            </div>
        </div>
                
              
         
    </div>
            
                </div>
    
    

        
   

    
    
     <div class="box">
            <div class="box-header">
                 <div class="box-title">
                        SalesOrder Details
                              
                    </div>
                <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                    </ul>
                    <div class="box-tools pull-right">
                          
        
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
       <?php yii\widgets\Pjax::begin()?> 
      <?php if($rowcount >0):?>          
                
      <table class="table table-striped table-bordered" style="margin-top: 10px">
      <thead>
        <tr>
          <th width="40px" style="text-align: right">NO</th>
          <th width="130px">CUST.NO.</th>
          <th>DESCRIPTION</th>
          <th style="text-align: right">QUANTITY</th>
          <th width="" style="text-align: right">UNIT PRICE</th>
          <th width="" style="text-align: right">TOTAL AMOUNT</th>
          <th width="" style="text-align: right">PARTNO</th>
          <th width=""></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($saleline as $product): ?>
        <tr>
          <td style="text-align: right"><?php echo $product->saleline; ?></td>
          <td><?php echo $product->custorderno; ?></td>
          <td><?php echo $product->customername; ?></td>
          <td style="text-align: right"><?php echo $product->quantity; ?></td>
          <td style="text-align: right">
            <?php echo number_format($product->unitprice,2);?>
          </td>
          <td style="text-align: right">
            <?php echo number_format($product->totalamount,2); ?>
          </td>
          <td style="text-align: right"><?php echo $product->partno; ?></td>
          <td style="text-align: center">
<!--            <a href="index.php?r=productimage/index&product_id=<?php //echo $product->id; ?>" 
              class="btn btn-info">
              <i class="glyphicon glyphicon-picture"></i>
            </a>
            <a href="index.php?r=product/edit&id=<?php //echo $product->id; ?>" 
              class="btn btn-success">
              <i class="glyphicon glyphicon-pencil"></i>
            </a>-->
<a href="index.php?r=saleorder/removeline&id=<?php echo $product->recid; ?>&pid=<?php echo $model->recid; ?>" 
              class="btn btn-danger" 
              onclick="return confirm('Are you sure delete date ?')">
              <i class="glyphicon glyphicon-remove"></i>
            </a>
          </td>
        </tr>
      </tbody>
      <?php endforeach; ?>
    </table>

    <?php echo LinkPager::widget([
        'pagination' => $pages,
      ]); 
    ?>
                <?php endif;?>
                <?php yii\widgets\Pjax::end()?> 
            </div>
     </div>
    
 <?php ActiveForm::end(); ?>

</div>
<?php 

$this->registerJs('
      
$(function(){
  
//$("#btnsubmit").click(function(){
//  if(1>0)
//  {
//    alert("OK");
//    e.preventDefault();
//    return false;
//  }
//});


  $("#currency").change(function(){
    var cr = $("option:selected",$(this)).text().toLowerCase();
    var url = "../../uploads/icon/";
     var convertto = $(this).find("option:selected").text();
    $("#imgcur").attr("src",url+cr+".png");
      
       var rateApi = "http://api.fixer.io/latest?base="+convertto.trim();
                   
                    $.getJSON(rateApi,{
                        tags: "mount rainier",
                        tagmode: "any",
                        format: "json"
                      })
                     .done(function(data){
                        
                     //   alert(convertto);
                        $.each(data.rates,function(key , val){
                       // alert(key + " = " + val);
                          if(key == "THB")
                          {
                          //alert(val);
                          $("#currate").val(val);
                          return;
                          }
                         

                        });
                     })
                     .fail(function(){
                    // alert("fail");
                     });
                     if(convertto.trim() == "THB"){
            $("#currate").val("1");
         }


  });
$("#geninvoice").click(function(){
        var recid = $(".salenoid").attr("id");
        var Url = "' . \yii::$app->getUrlManager()->createUrl('saleorder/removeall') . '";//$(this).attr("value");
});
$("#removeupload").click(function(){
        var recid = $(".salenoid").attr("id");
        var Url = "' . \yii::$app->getUrlManager()->createUrl('saleorder/removeall') . '";//$(this).attr("value");
       
if(recid < 1){
  alert("ไม่มีรายการให้ลบ");
  return;
}

       if(confirm("คุณต้องการลบรายละเอียดของ Sale order นี้ใช่หรือไม่"))
       { // alert(recid);
        $.ajax({
            type:"post",
            dataType: "html",
            url: Url,
            data:{id: recid},
            success: function(data){
                   //  alert("ss"); 
                    
                }
        });
       }
     
    });

});

      '  );
?>
