<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Setuser */

$this->title = 'Update Setuser: ' . ' ' . $model->recid;
$this->params['breadcrumbs'][] = ['label' => 'Setusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recid, 'url' => ['view', 'id' => $model->recid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="setuser-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
