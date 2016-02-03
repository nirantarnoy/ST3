<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Genreport */

$this->title = 'Update Genreport: ' . ' ' . $model->Sale_Code;
$this->params['breadcrumbs'][] = ['label' => 'Genreports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Sale_Code, 'url' => ['view', 'id' => $model->Sale_Code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="genreport-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
