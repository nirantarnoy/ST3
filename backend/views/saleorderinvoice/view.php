<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Saleorderinvoice */

$this->title = $model->invoiceno;
$this->params['breadcrumbs'][] = ['label' => 'Saleorderinvoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
  <?php $invline = new \backend\models\Saleorderinvoiceline();?>
<div class="saleorderinvoice-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            //'recid',
            'invoiceno',
            //'invoicedate',
            [
                'attribute'=>'invoicedate',
                'value'=>Yii::$app->formatter->asDate($model->invoicedate,'dd-MM-yyyy') ,
                
            ],
           // 'invcurrency',
            [
                'attribute'=>'invcurrency',
                'value'=>$model->invcurrency?$model->currencyname->currencycode:'',
            ],
            'invcurrencyrate',
           // 'customerid',
             [
                'attribute'=>'customerid',
                'value'=>$model->customerid?$model->customername->Cus_Name:'',
            ],
             [
                'attribute'=>'totalqty',
                'value'=> number_format($invline->Ordersum($model->recid))." Pcs",
            ],
            [
                'attribute'=>'totalamt',
                'value'=> number_format($invline->Usdsum($model->recid))." ".$model->currencyname->currencycode,
            ],
             [
                'attribute'=>'totalthb',
                'value'=> $model->currencyname->currencycode !='THB'? number_format($invline->Usdsum($model->recid)* $model->invcurrencyrate)." THB":number_format($invline->Thbsum($model->recid))." ".$model->currencyname->currencycode,
            ],
            'createdate',
        ],
    ]) ?>

</div>
