<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

$this->title = "Detail " . $model->Cus_id;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

  
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Cus_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Cus_id], [
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
            'Cus_id',
            'Cus_Name',
            'Cus_Nickname',
            'Cus_Phone',
            'Cus_Fax',
            'Cus_Email:email',
            'Cus_Website',
            'Cus_Address',
            'Cus_Contactname',
            'Cus_Customeras',
            'Cus_Country',
            'Cus_Province',
            'Cus_ContactPhone',
            'Cus_Description',
            'ts_create',
            'ts_update',
            'ts_name',
            'IsDelete',
        ],
    ]) ?>

</div>
