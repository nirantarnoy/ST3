<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Saleorderinvoice */

$this->title = 'Saleorder invoice upload';
$this->params['breadcrumbs'][] = ['label' => 'Saleorderinvoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saleorderinvoice-create">

   
    <?= $this->render('_form', [
        'model' => $model,
         'saleline' => $saleline,
         'rowcount' => $rowcount,
         'saleincluded'=>$saleincluded,
        'saleincludedcount'=>$saleincludedcount,
    ]) ?>

</div>
