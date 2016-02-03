<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
         'id'=>'gridId',
        'panel'=>[
             'type'=>GridView::TYPE_DANGER,
            'heading'=>$this->render('_search', ['model' => $searchModel]),
        ],
        'toolbar'=>[
              ['content'=>Html::a('สร้างใหม่', ['create'], ['class' => 'btn btn-primary'])],
               '{toggleData}','{export}',
        ]
        ,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'header'=>'No',
               'headerOptions' => ['style' => 'text-align: center'],
                'contentOptions' => ['style' => 'text-align: center']
                ],
             
            'Cus_Name',
            'Cus_Nickname',
            'Cus_Phone',
            'Cus_Fax',
            // 'Cus_Email:email',
            // 'Cus_Website',
            // 'Cus_Address',
            // 'Cus_Contactname',
            // 'Cus_Customeras',
            // 'Cus_Country',
            // 'Cus_Province',
            // 'Cus_ContactPhone',
            // 'Cus_Description',
            // 'ts_create',
            // 'ts_update',
            // 'ts_name',
            // 'IsDelete',

            [
                        'header' => 'Action',
                        'headerOptions' => ['style' => 'width: 160px;text-align:center;', 'class' => 'activity-view-link',],
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['style' => 'text-align: center'],
                        'buttons' => [
                            'view' => function($url, $data, $index) {
                                $options = [
                                    'title' => Yii::t('yii', 'View'),
                                    'aria-label' => Yii::t('yii', 'View'),
                                    'data-pjax' => '0',
                                ];
                                return Html::a(
                                                '<span class="glyphicon glyphicon-eye-open btn btn-default"></span>', $url, $options);
                            },
                                    'update' => function($url, $data, $index) {
                                $options = array_merge([
                                    'title' => Yii::t('yii', 'Update'),
                                    'aria-label' => Yii::t('yii', 'Update'),
                                    'data-pjax' => '0',
                                    'id' => 'modaledit',
                                ]);
                                return Html::a(
                                                '<span class="glyphicon glyphicon-pencil btn btn-default"></span>', $url, [
                                            'id' => 'activity-view-link',
                                            //'data-toggle' => 'modal',
                                            // 'data-target' => '#modal',
                                            'data-id' => $index,
                                            'data-pjax' => '0'
                                ]);
                            },
                                    'delete' => function($url, $data, $index) {
                                $options = array_merge([
                                    'title' => Yii::t('yii', 'Delete'),
                                    'aria-label' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]);
                                return Html::a('<span class="glyphicon glyphicon-trash btn btn-default"></span>', $url, $options);
                            }
                                ]
                            ],
        ],
    ]); ?>

</div>
