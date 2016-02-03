<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Saleorderline */

$this->title = 'Create Saleorderline';
$this->params['breadcrumbs'][] = ['label' => 'Saleorderlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saleorderline-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
