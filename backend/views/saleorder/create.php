<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Saleorder */

$this->title = 'Saleorder Upload';
$this->params['breadcrumbs'][] = ['label' => 'Saleorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saleorder-create">


    <?= $this->render('_form', [
        'model' => $model,
         'saleline' => $saleline,
         'rowcount' => $rowcount,
         
    ]) ?>

</div>
