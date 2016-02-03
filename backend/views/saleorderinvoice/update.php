<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Saleorderinvoice */

$this->title = 'Update Saleorder invoice: ' . ' ' . $model->invoiceno;
$this->params['breadcrumbs'][] = ['label' => 'Saleorderinvoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->invoiceno, 'url' => ['view', 'id' => $model->recid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="saleorderinvoice-update">


    <?= $this->render('_form', [
        'model' => $model,
         'saleline' => $saleline,
         'pages' => $pages,
         'rowcount'=>$rowcount,
         'saleincluded'=>$saleincluded,
        'saleincludedcount'=>$saleincludedcount,
    ]) ?>

</div>
