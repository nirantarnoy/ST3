<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Genreport */

$this->title = 'Create Genreport';
$this->params['breadcrumbs'][] = ['label' => 'Genreports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genreport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
