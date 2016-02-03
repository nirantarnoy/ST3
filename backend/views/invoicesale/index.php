<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InvoicesaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Saleorder';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoicesale-index">

    <h3><?php //echo Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?php //echo Html::a('Create Invoicesale', ['create'], ['class' => 'btn btn-success'])  ?>
    </p>
    <?php Pjax::begin(['id' => 'pjax-sale']); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'filterPosition'=>'header', 
        'summary' => '',
        'id' => 'gridId',
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            // 'recid',
              [
                                'class' => 'yii\grid\CheckboxColumn',
                                'checkboxOptions' => function($model) {
                                    return ['value' => \yii\helpers\ArrayHelper::getValue($model, 'recid'),
                                        'checked' => false,
                                        'onClick' => ''
                                        . 'if(this.checked){'
                                        . 'this.parentElement.parentElement.style.backgroundColor="#CCFFCC";'
                                        . '}'
                                        . 'else{'
                                        . 'this.parentElement.parentElement.style.backgroundColor="white";'
                                        . '}'
                                    ];
                                },
                                    ],
            'saleno',
            [
                'attribute' => 'saledate',
                'value' => function($data) {
                    return Yii::$app->formatter->asDate($data->saledate, 'dd-MM-yyyy');
                }
            ],
            'refno',
            //'customer',
                    [
                        'attribute'=>'customer',
                        'value'=>'customername.Cus_Name',
                    ],
                    
//            [
//                'attribute' => 'customer',
//                'value' => function($data) {
//                    return isset($data->customer) ? $data->customername->Cus_Name : "";
//                }
//            ],
            //'saleman',
            [
              'attribute'=>'saleman',
               'value'=>'salename.Sale_Name',
            ],
//            [
//                'attribute' => '_saleman',
//                'value' => function($data) {
//                    return isset($data->saleman) ? $data->salename->Sale_Name : "";
//                }
//            ],
        // 'saledate',
        // 'customer',
        // 'saleman',
        // 'refno',
        // 'description',
        // 'shipdate',
        // 'shipfrom',
        // 'shipto',
        // 'paymentterm',
        // 'currency',
        // 'currencyrate',
        // 'createdate',
        // 'createby',
        // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
    <div class="row">
        <div class="col-lg-5"></div>
        <div class="col-lg-3"> <div style="height: 50px;width: 100%;padding: 15px;" class="btn btn-primary selectid">ตกลง</div></div>
    </div>
   
</div>
<?php $this->registerJs(
        '$(function(){
            $(".selectid").click(function(){
                var recid = $("#gridId").yiiGridView("getSelectedRows");
                var Urls = "' . \yii::$app->getUrlManager()->createUrl('invoicesale/createid') . '"; 
       
                if(recid < 1){
                    alert("คุณยังไม่เลือกรายการใดๆ");
                    return;
                }else{
                    alert(recid);
                }
                
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "' . \yii::$app->getUrlManager()->createUrl('invoicesale/createid') . '",
                    data:{invid: recid},
                    success: function(data){
                        alert(data);
                       //$(this).modal("hide");
                    },
                    error: function(data){
                        //alert("s");
                    }
                    
                });
               
                
            });
        });'
);?>
