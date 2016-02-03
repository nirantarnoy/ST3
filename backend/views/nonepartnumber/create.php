<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Nonepartnumber */

$this->title = 'Create Nonepartnumber';
$this->params['breadcrumbs'][] = ['label' => 'Nonepartnumbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nonepartnumber-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
