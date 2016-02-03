<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Saleorderline */

$this->title = 'Update Saleorderline: ' . ' ' . $model->recid;
$this->params['breadcrumbs'][] = ['label' => 'Saleorderlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recid, 'url' => ['view', 'id' => $model->recid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="saleorderline-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
