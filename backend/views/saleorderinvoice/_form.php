<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\grid\GridView;
use yii\web\Session;
use yii\widgets\LinkPager;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\select2\Select2;
$session = new Session();
$session->open();

/* @var $this yii\web\View */
/* @var $model backend\models\Saleorderinvoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="saleorderinvoice-form">
       <?php $customer = new \backend\models\Customer();
        $currency = new \backend\models\Currency();
         $invorline = new \backend\models\Saleorderinvoiceline();
        ?>
   <?php $form = ActiveForm::begin(['id'=>'myform2','options'=>['class'=>'form-horizontal','enctype'=>'multipart/form-data']]); ?>

    <div class="salenoid"  <?php echo "id=$model->recid"; ?>></div>
    
        <?php if(!empty($session->getFlash('msgsuccess'))):?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?=$session->getFlash('msgsuccess');?>
        </div>
        <?php endif;?>
    
<div class="box">
            <div class="box-header">
                 <div class="box-title">
                        Invoice Header
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
          
   
    <label class="control-label col-sm-3" for="inputSuccess3">Invoice no</label>
    <div class="col-sm-9">
    <?= $form->field($model, 'invoiceno')->textInput()->label(false) ?>
        <?php if(!empty($session->getFlash('modelerror'))):?>
        <div class="alert alert-error">
            <?=$session->getFlash('modelerror');?>
        </div>
        <?php endif;?>
    </div>
 

    <label class="control-label col-sm-3" for="inputSuccess3">Invoice date</label>
    <div class="col-sm-9 form-group">
    
           <?php
               // echo '<label>Sales order date</label>';
                echo DatePicker::widget([
                    'name' => 'invoicedate',
                    'model' => $model,
                    'attribute' => 'invoicedate',
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
      <?= $form->field($model, 'customerid')->widget(Select2::classname(), [
    'data' => ArrayHelper::map($customer->find()->all(),"Cus_id",  function($data){return $data->getFullname() ;}),
    'language' => 'en',
    'options' => ['placeholder' => 'Select customer......'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label(false)?>
    </div>
  <label class="control-label col-sm-3" for="inputSuccess3">Discount %</label>
    <div class="col-sm-9">
    <?= $form->field($model, 'disper')->textInput()->label(false) ?>
    </div>
    <label class="control-label col-sm-3" for="inputSuccess3">other</label>
    <div class="col-sm-9">
    <?= $form->field($model, 'boxprc')->textInput()->label(false) ?>
    </div>
    
     <label class="control-label col-sm-3" for="inputSuccess3">Summary</label>
    <div class="col-sm-9">
        <div class="row" style="background-color: gray">
            <div class="col-sm-4">
                <div style="color: white;text-align: right;">
                    <h5>
                          <?php echo number_format($invorline->ordersum($model->recid),0).' '.'PCS.';?>
                    </h5>
                  
                </div>
                
            </div>
             <?php if(isset($model->currencyname->currencycode)):?>
              <?php if($model->currencyname->currencycode != "THB"):?>
                    <div class="col-sm-4">
                         <div style="color: white;text-align: right;">
                    <h5>
                <?php echo number_format($invorline->usdsum($model->recid),2).' '.$model->currencyname->currencycode;?>
                    </h5>
                         </div>
            </div>
              <?php //elseif($model->currencyname->currencycode == "THB"):?>
            <div class="col-sm-4">
                 <div style="color: white;text-align: right;">
                    <h5>
                 <?php 
                  if($model->currencyname->currencycode != "THB"){
                      echo number_format($invorline->Usdsum($model->recid)*$model->invcurrencyrate).' '.'THB';
                  }else{
                      echo number_format($invorline->thbsum($model->recid),2).' '.'THB';
                  }
                 
                 ?>
                    </h5>
                 </div>
            </div>
      <?php endif;?>
            <?php endif;?>
        </div>
      
     
    
    </div>
    
    <?php if($saleincludedcount >0):?>
    <label class="control-label col-sm-3" for="inputSuccess3"></label>
    <div class="col-sm-9">
     <!--Section show saleorder references -->
   <div class="box">
            <div class="box-header">
                 <div class="box-title">
                        Sale order included
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
                <table class="table table-striped table-bordered" style="margin-top: 0px">
      
      <tbody>
        <?php foreach ($saleincluded as $sales): ?>
        <tr>
            <td><i class="glyphicon glyphicon-check"></i> <span class="badge bg-green"><a style="color: #ffffff;" href="index.php?r=saleorder/update&id=<?= $sales->saleid;?>"> <?php echo $sales->saleorder->saleno; ?></a></span></td>
          
        </tr>
      </tbody>
      <?php endforeach; ?>
    </table>
            </div>
   </div>
          <!--End Section show saleorder references -->
    </div>
    <?php endif;?>
    
        </div>
        <div class="col-md-6">
            
            
                    
       <label class="control-label col-sm-3" for="inputSuccess3">Currency</label>
    <div class="col-sm-9">
        <div class="col-sm-9">
             <?= $form->field($model, 'invcurrency')->dropDownList(
              
 ArrayHelper::map($currency->find()->all(),"recid","currencycode"),['id'=>'currency','prompt'=>'Select currency......']
              )->label(false) ?>
        </div>
          <div class="col-sm-3">
              <img id="imgcur" src="<?= isset($model->invcurrency)? '../../uploads/icon/'.$model->currencyicon->icon:'';?>" style="width: 30px;" >
        </div>
     
    </div>
      
<label class="control-label col-sm-3" for="inputSuccess3">Currency rate</label>
    <div class="col-sm-9">
        <div class="col-sm-9">
            <?= $form->field($model, 'invcurrencyrate')->textInput(['id'=>'currate'])->label(false) ?>
        </div>
      
    </div>

<label class="control-label col-sm-3" for="inputSuccess3"></label>
    <div class="col-sm-9">
              <div style="margin-left: 0px;">
             <h5> Last update: <?= $model->createdate?> </h5>
        <h5> Update by: <?= $model->createby?></h5>
        </div>
    </div>

<label class="control-label col-sm-3" for="inputSuccess3"></label>
<div class="col-sm-9" style="margin-bottom: 10px;">
              <div style="margin-left: 0px;">
<!--             <div class="btn btn-default">เลือกรายการจาก Saleorder</div>-->
             <?= Html::button('เลือกรายการจาก Saleorder',['value'=>Url::to(['index.php?r=invoicerefsale/index']),'class'=>'btn btn-default','id'=>'btnshowsale'])?>
        </div>
    </div> 
   <label class="control-label col-sm-3" for="inputSuccess3"></label>
    <div class="col-sm-9">
        <div style="margin-left: 15px;">
             <?php //echo $form->field($model, 'upfile')->fileInput(['class'=>'btn btn-default']) ?>
            
        </div>
           
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
           <?= Html::button('Remove detail',['value'=>Url::to(['index.php?r=saleorder/removeall']),'class'=>'btn btn-danger','id'=>'removeupload'])?>
           <?php //echo Html::button('Saleorder',['value'=>Url::to(['index.php?r=invoicerefsale/index']),'class'=>'btn btn-info','id'=>'btnshowsale'])?>
              
        </div>
   
    </div>
   
            </div>
        </div>
                
              
         
    </div>
            
                </div>
<div class="box">
            <div class="box-header">
                 <div class="box-title">
                        Invoice Details
                              
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
       <?php // yii\widgets\Pjax::begin()?> 
      <?php if($rowcount >0):?>          
                <div class="data-table">
      <?php yii\widgets\Pjax::begin(['id'=>'pjax-test'])?>
                    <table class="table table-striped table-bordered" style="margin-top: 0px">
      <thead>
        <tr>
          <th width="40px" style="text-align: right">NO</th>
          <th width="130px">PART.NO.</th>
          <th>DESCRIPTION</th>
          <th style="text-align: right">QUANTITY</th>
          <th style="text-align: right">INVQTY</th>
          <th width="" style="text-align: right">UNIT PRICE</th>
          <th width="" style="text-align: right">TOTAL AMOUNT</th>
          
          <th width=""></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($saleline as $product): ?>
      
        <tr id="<?=$product->recid;?>">
          <td style="text-align: center; vertical-align: middle;"><?php echo $product->invline; ?></td>
          <td style="vertical-align: middle;"><?php echo $product->partno; ?></td>
          <td style="vertical-align: middle;"><?php echo $product->description; ?></td>
          <td style="text-align: right;vertical-align: middle;">
              <input type="text" style="border: none;background: none;width: 50px; text-align: right;" name="saleqty" readonly="readonly" value="<?php echo $product->quantity; ?>">
              </td>
          <td style="text-align: right;vertical-align: middle;">
              <input class="invqty" style="width: 50px; text-align: right;" maxlength="6" type="text"  value="<?php echo $product->invoiceqty; ?>"
          </td>
          <td style="text-align: right;vertical-align: middle;">
               <input type="text" style="border: none;background: none;width: 50px; text-align: right;" name="unitprice" readonly="readonly" value="<?php echo number_format($product->unitprice,2); ?>">
            
          </td>
          <td style="text-align: right;vertical-align: middle;">
               <input type="text" style="border: none;background: none;width: 50px; text-align: right;" name="linetotal" readonly="readonly" value="<?php echo number_format($product->totalamount,2); ?>">
            
          </td>
         
          <td style="text-align: center">
<!--            <a href="index.php?r=productimage/index&product_id=<?php //echo $product->id; ?>" 
              class="btn btn-info">
              <i class="glyphicon glyphicon-picture"></i>
            </a>
            <a href="index.php?r=product/edit&id=<?php //echo $product->id; ?>" 
              class="btn btn-success">
              <i class="glyphicon glyphicon-pencil"></i>
            </a>-->
            <a href="index.php?r=saleorderinvoice/removeline&id=<?php echo $product->recid; ?>&pid=<?php echo $model->recid; ?>" 
              class="btn btn-danger" 
              onclick="return confirm('Are you sure delete date ?')">
              <i class="glyphicon glyphicon-remove"></i>
            </a>
          </td>
        </tr>
      </tbody>
      <?php endforeach; ?>
    </table>
        <?php //yii\widgets\Pjax::end();?>
                </div>          
      

    <?php echo LinkPager::widget([
        'pagination' => $pages,
      ]); 
    ?>
        <?php yii\widgets\Pjax::end()?> 
                <?php endif;?>
                
            </div>
     </div>
    <?php ActiveForm::end(); ?>

    <?php Modal::begin([
         'header' => '<h4>Saleorder</h4>',
                'id' => 'modal',
                // 'data-backdrop'=>false,
                'size' => 'modal-lg',
                'options' => ['data-backdrop' => 'static',
                    ],
                'footer' => '<a href="#" class="btn btn-danger" data-dismiss="modal">ยกเลิก</a>',
    ]);
    echo  "<div id='showmodal'></div>";
    ?>
   
    <?php Modal::end()?>
    
</div>
<?php 

$this->registerJs('
      
$(function(){
   
  $(".data-table table tbody .invqty").keypress(function(e){
     var idd = $(this).closest("tr").attr("id");
     var sqty = $(this).closest("tr").find("input[name=saleqty]").val();
     var qty = parseInt($(this).val().trim());
     var unitprice = $(this).closest("tr").find("input[name=unitprice]").val();
     
     var totalinput = $(this).closest("tr").find("input[name=linetotal]");
     var Url = "' . \yii::$app->getUrlManager()->createUrl('saleorderinvoice/updateline') . '";

      
      if(e.which != 8 && e.which != 0 && (e.which >=48 && e.which <=57)){
        //alert(e.which);
      }else{
        e.preventDefault();
      }
        
         

    if(e.which == 13){
    //alert(qty);
    if(qty > sqty)
    {
        alert("จำนวนที่ต้องการส่งมากกว่าจำนวนใน saleorder");
        $(this).val(sqty);
        return;
    }
    $(this).val(qty);
        $.ajax({
            type: "post",
            dataType: "html",
            url: Url,
            data:{recid: idd,qty: qty},
            success: function(data){
               // alert(data);
                totalinput.val(qty * unitprice);
                totalinput.formatNumber({format:"#,###.00", locale:"us"});
            },
            error:function(data){
               // alert("NO");
            }
        });
    }
     

  });


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

$("#removeupload").click(function(){
        var recid = $(".salenoid").attr("id");
        var Url = "' . \yii::$app->getUrlManager()->createUrl('saleorderinvoice/removeall') . '";//$(this).attr("value");
       
if(recid < 1){
  alert("ไม่มีรายการให้ลบ");
  return;
}

       if(confirm("คุณต้องการลบรายละเอียดของ Invoice นี้ใช่หรือไม่"))
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
    
     $("#btnshowsale").click(function(){
    //  var Urls = "' . \yii::$app->getUrlManager()->createUrl('invoicerefsale/createid') . '";//$(this).attr("value");
      var Urls = "' . \yii::$app->getUrlManager()->createUrl('invoicesale/createinvid') . '";//$(this).attr("value");
   
        var invid = $(".salenoid").attr("id");
         
        if(invid == null || invid =="")
        {
         alert("ต้องทำการบันทึก invoice ก่อน");
         return;
        }
  
        $.ajax({
            type:"post",
            dataType: "html",
            url: Urls,
            data:{invid: invid},
            success: function(data){
                   //  alert("ss"); 
                    
                },
            error:function(data){
              
            }
                
        });     

   
    var xurl = "' . \yii::$app->getUrlManager()->createUrl('invoicesale/index') . '";
        $("#modal").modal("show")
        .find("#showmodal")
        .load(xurl);
       
    });


});

      '  );
?>
