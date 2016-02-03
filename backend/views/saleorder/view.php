<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\models\Saleorder */

$this->title = $model->saleno;
$this->params['breadcrumbs'][] = ['label' => 'Saleorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
   <?php $saleline = new \backend\models\Saleorderline();?>
<div class="saleorder-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->recid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->recid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'recid',
            'saleno',
            //'saledate',
            [
                'attribute'=>'saledate',
                'value'=>Yii::$app->formatter->asDate($model->saledate,'dd-MM-yyyy') ,
                
            ],
            //'customer',
            //'saleman',
            [
                'attribute'=>'customer',
                'value'=>$model->customer? $model->customername->Cus_Name:"",
                
            ],
   //         'saleman',
            [
                'attribute'=>'saleman',
                'value'=>$model->saleman?$model->salename->Sale_Name:'',
            ],
            'refno',
            'description',
             [
                'attribute'=>'shipdate',
                'value'=>Yii::$app->formatter->asDate($model->shipdate,'dd-MM-yyyy') ,
                
            ],
           // 'shipfrom',
           // 'shipto',
            [
                'attribute'=>'shipfrom',
                'value'=>$model->shipfrom?$model->shipfromname->Cry_nameEN:'',
                
            ],
           [
                'attribute'=>'shipto',
                'value'=>$model->shipto?$model->shiptoname->Cry_nameEN:'',
                
            ],
            'paymentterm',
            //'currency',
             [
                'attribute'=>'currency',
                'value'=>$model->currency?$model->currencyname->currencycode:'',
            ],
            [
                'attribute'=>'totalqty',
                'value'=> number_format($saleline->Ordersum($model->recid))." Pcs",
            ],
            [
                'attribute'=>'totalamt',
                'value'=> number_format($saleline->Usdsum($model->recid))." ".$model->currencyname->currencycode,
            ],
          [
                'attribute'=>'totalthb',
                'value'=> $model->currencyname->currencycode !='THB'? number_format($saleline->Usdsum($model->recid)* $model->currencyrate)." THB":number_format($saleline->Thbsum($model->recid))." ".$model->currencyname->currencycode,
            ],
          // 'totalqty',
            'currencyrate',
            'createdate',
        ],
    ]) ?>

</div>
