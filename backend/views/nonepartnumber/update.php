<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Nonepartnumber */

$this->title = 'Update Nonepartnumber: ' . ' ' . $model->recid;
$this->params['breadcrumbs'][] = ['label' => 'Nonepartnumbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recid, 'url' => ['view', 'id' => $model->recid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nonepartnumber-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
