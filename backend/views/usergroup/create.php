<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Usergroup */

$this->title = 'Create Usergroup';
$this->params['breadcrumbs'][] = ['label' => 'Usergroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usergroup-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
