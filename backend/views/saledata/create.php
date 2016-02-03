<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Saledata */

$this->title = 'Create Saledata';
$this->params['breadcrumbs'][] = ['label' => 'Saledatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saledata-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
