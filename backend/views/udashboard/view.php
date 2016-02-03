<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Udashboard */

$this->title = $model->recid;
$this->params['breadcrumbs'][] = ['label' => 'Udashboards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="udashboard-view">

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
            'recid',
            'invoiceno',
            'invoicedate',
            'invcurrency',
            'invcurrencyrate',
            'customerid',
            'createdate',
            'disper',
            'boxprc',
        ],
    ]) ?>

</div>
