<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Udashboard */

$this->title = 'Create Udashboard';
$this->params['breadcrumbs'][] = ['label' => 'Udashboards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="udashboard-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
