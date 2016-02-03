<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Saledata */

$this->title = $model->Sale_Code;
$this->params['breadcrumbs'][] = ['label' => 'Saledatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saledata-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Sale_Code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Sale_Code], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Sale_Code',
            'Sale_Name',
            'Sale_Lastname',
            'Sale_Address',
            'Sale_Province',
            'Sale_Contact',
            'Sale_Email:email',
            'Sale_Branch',
            'Sale_Description',
            'ts_create',
            'ts_update',
            'ts_name',
            'IsDelete',
        ],
    ]) ?>

</div>
