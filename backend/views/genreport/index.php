<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genreport-index">
    <div class="box box-success">
        <div class="box-body">
            
         
   
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box box-body">
                      <a href="index.php?r=reportcon" id = "btnprint" onclick="return false;">
                    <i class="glyphicon glyphicon-list"></i>
                     1.รายงานยอดขายตาม INVOICE แยกตามผู้ขาย
                </a>
                </div>
              
            </div>
            <?php //echo Html::button('รายงานยอดขายตาม INVOICE แยกตามผู้ขาย',['value'=>\yii\helpers\Url::to(['/reportcon']),'class' => 'btn form-control','id' => 'btnprint']);?>
        </div>
       <div class="col-md-4">
            <div class="box box-warning">
                <div class="box box-body">
                      <a href="index.php?r=reportcon" id = "btnprint1" onclick="return false;">
                    <i class="glyphicon glyphicon-list"></i>
                    2.รายงานเปรียบเทียบมูลค่าขายแยกตามผู้ขาย
                </a>
                </div>
              
            </div>
         
        </div>
       <div class="col-md-4">
            <div class="box box-warning">
                <div class="box box-body">
                      <a href="index.php?r=reportcon" id = "btnprint2" onclick="return false;">
                    <i class="glyphicon glyphicon-list"></i>
                    3.รายงานเปรียบเทียบยอดใบสั่งขายระหว่างปี
                </a>
                </div>
              
            </div>
           <?php //echo Html::button('รายงานเปรียบเทียบยอดใบสั่งขายระหว่างปี',['value'=>\yii\helpers\Url::to(['/reportcon']),'class' => 'btn form-control','id' => 'btnprint']);?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 form-group">
           <div class="box box-warning">
                <div class="box box-body">
                      <a href="index.php?r=reportcon" id = "btnprint3" onclick="return false;">
                    <i class="glyphicon glyphicon-list"></i>
                   4.รายงานเปรียบเทียบยอดขายตาม ACT-INVOICE
                </a>
                </div>
              
            </div>
            <?php //echo Html::button('รายงานเปรียบเทียบยอดขายตาม ACT-INVOICE',['value'=>\yii\helpers\Url::to(['/reportcon']),'class' => 'btn form-control','id' => 'btnprint']);?>
        </div>
       <div class="col-md-4">
           <div class="box box-warning">
                <div class="box box-body">
                      <a href="index.php?r=reportcon" id = "btnprint4" onclick="return false;">
                    <i class="glyphicon glyphicon-list"></i>
                    5.รายงานเปรียบเทียบยอดขายตามกลุ่มสินค้า
                </a>
                </div>
              
            </div>
         <?php //echo Html::button('รายงานเปรียบเทียบยอดขายตามกลุ่มสินค้า',['value'=>\yii\helpers\Url::to(['/reportcon']),'class' => 'btn form-control','id' => 'btnprint']);?>
        </div>
       <div class="col-md-4">
            <div class="box box-warning">
                <div class="box box-body">
                      <a href="index.php?r=reportcon" id = "btnprint5" onclick="return false;">
                    <i class="glyphicon glyphicon-list"></i>
                    6.รายงานเปรียบเทียบยอดขายระหว่างปี
                </a>
                </div>
              
            </div>
          <?php //echo Html::button('รายงานเปรียบเทียบยอดขายระหว่างปี   ',['value'=>\yii\helpers\Url::to(['/reportcon']),'class' => 'btn form-control','id' => 'btnprint']);?>
        </div>
    </div>
     <div class="row">
        <div class="col-md-4 ">
           <div class="box box-warning">
                <div class="box box-body">
                      <a href="index.php?r=reportcon" id = "btnprint6" onclick="return false;">
                    <i class="glyphicon glyphicon-list"></i>
                    7.รายงานยอดขายแยกตามลูกค้า
                </a>
                </div>
              
            </div>
           <?php //echo Html::button(' รายงานยอดขายแยกตามลูกค้า   ',['value'=>\yii\helpers\Url::to(['/reportcon']),'class' => 'btn form-control glyphicon glyphicon-gift','id' => 'btnprint']);?>
        </div>
       <div class="col-md-4">

        </div>
       <div class="col-md-4">
    
        </div>
    </div>
           
 </div>
        </div>
   </div> 
    

<?php Modal::begin([
         'header' => '',
                'id' => 'modal',
                // 'data-backdrop'=>false,
                'size' => 'md_lg',
                'options' => ['data-backdrop' => 'static',
                    ],
               // 'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
    ]);
    echo  "<div id='showmodal'></div>";
    ?>
<?php $this->registerJs('
   $(function(){
     $("#btnprint").click(function(){
          $("#modal").modal("show").find("#showmodal").load($(this).attr("href"));
     });
       $("#btnprint1").click(function(){
       
           var Url = "' . \yii::$app->getUrlManager()->createUrl('reportcon/regis') . '";
           $.ajax({
            type:"post",
            dataType: "html",
            url: Url,
            data:{module: 2},
            success: function(data){
                    // alert("ss"); 
                    
                }
        });
          $("#modal").modal("show").find("#showmodal").load($(this).attr("href"));
     });
     $("#btnprint2").click(function(){
       
           var Url = "' . \yii::$app->getUrlManager()->createUrl('reportcon/regis') . '";
           $.ajax({
            type:"post",
            dataType: "html",
            url: Url,
            data:{module: 3},
            success: function(data){
                    // alert("ss"); 
                    
                }
        });
          $("#modal").modal("show").find("#showmodal").load($(this).attr("href"));
     });
   });
   
'); ?>