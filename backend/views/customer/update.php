<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

$this->title = 'Update Customer: ' . ' ' . $model->Cus_id;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Cus_id, 'url' => ['view', 'id' => $model->Cus_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-update">

  

    <?= $this->render('_form', [
        'model' => $model,
          'sale'=>$sale,
                'country'=>$country,
                'province'=>$province,
                'xmodel'=>$xmodel,
                'updatesale'=>$updatesale,
                'updatecom'=>$updatecom,
                'updatesec'=>$updatesec,
                'updatedep'=>$updatedep,
                'secmodel'=>$secmodel,
                'depmodel'=>$depmodel,
    ]) ?>

</div>
