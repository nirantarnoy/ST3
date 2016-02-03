<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Setuser */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Setusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setuser-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
