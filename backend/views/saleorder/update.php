<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Saleorder */

$this->title = 'Update Saleorder: ' . ' ' . $model->saleno;
$this->params['breadcrumbs'][] = ['label' => 'Saleorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recid, 'url' => ['view', 'id' => $model->recid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="saleorder-update">

    <?= $this->render('_form', [
        'model' => $model,
         'saleline' => $saleline,
         'pages' => $pages,
         'rowcount'=>$rowcount,
                
    ]) ?>

</div>
