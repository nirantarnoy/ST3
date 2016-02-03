<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Udashboard */

$this->title = 'Update Udashboard: ' . ' ' . $model->recid;
$this->params['breadcrumbs'][] = ['label' => 'Udashboards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recid, 'url' => ['view', 'id' => $model->recid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="udashboard-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
