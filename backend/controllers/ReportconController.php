<?php
namespace backend\controllers;
use yii\web\Session;

class ReportconController extends \yii\web\Controller{
    public function actionIndex()
    {
        return $this->renderAjax('index');
    }
    public function actionRegis()
    {
        if (\yii::$app->request->isAjax) {
            
            $module = \yii::$app->request->post('module');
            
            $session = new Session();
            $session->open();

          
            $session['module'] = $module;
           
        }
    }
}

