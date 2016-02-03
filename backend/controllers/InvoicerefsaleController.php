<?php
namespace backend\controllers;

use backend\models\Saleorder;
use yii\web\Controller;
use yii\web\Session;
use backend\models\Invoicerefsale;



class InvoicerefsaleController extends Controller{
    public function init() {
//        $session = new Session();
//        $session->open();
//        if (empty($_SESSION['userid'])) {
//            return $this->redirect('index.php?r=login');
//        }
    }  
    public function actionIndex()
    {
        $count = Saleorder::find()->count();
        $model = Saleorder::find()->all();
        return $this->renderAjax('index',[
            'model'=>$model,
            'rowcount'=>$count,
        ]);
    }
    public function actionCreateid()
    {
         if (\yii::$app->request->isAjax) {
            $id = \yii::$app->request->post('invid');
            $session = new Session();
            $session->open();
            $session['invid'] = $id;
        }
    }
    public function actionAddsale()
    {
            $session = new Session();
            $session->open();
      
        if(!empty($_POST['sales']))
        {
            Invoicerefsale::deleteAll('invid = :invid',[':invid'=>$session['invid']]);
            
            foreach ($_POST['sales'] as $data)
            {
                $model2 = new \backend\models\Invoicerefsale(); 
                $model2->invid =$session['invid'];
                $model2->saleid = $data;
                
                $model2->save();
            }
            return $this->redirect(['saleorderinvoice/update','id'=>$session['invid']]);
        }
    }
}
