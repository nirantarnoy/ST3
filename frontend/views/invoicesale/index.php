<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InvoicesaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoicesales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoicesale-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Invoicesale', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'recid',
            'saleno',
            'saledate',
            'customer',
            'saleman',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
