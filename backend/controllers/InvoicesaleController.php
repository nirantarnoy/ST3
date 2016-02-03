<?php

namespace backend\controllers;

use Yii;
use backend\models\Invoicesale;
use backend\models\InvoicesaleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use backend\models\Saleorderline;
use backend\models\Saleorderinvoiceline;

 $session = new Session();
 $session->open();
/**
 * InvoicesaleController implements the CRUD actions for Invoicesale model.
 */
class InvoicesaleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                  //  'delete' => ['post'],
                    'createid' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Invoicesale models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvoicesaleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invoicesale model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Invoicesale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Invoicesale();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->recid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateid()
    {
            $session = new Session();
            $session->open();
         if (\yii::$app->request->isAjax) {
            $id = \yii::$app->request->post('invid');
            
            $session['invid'] = $id;
            
            $x;
            $count=0;
            foreach ($session['invid'] as $data){
//               
                $model = Saleorderline::find()->where(['saleid'=>$data])->all();
                $model2 = new \backend\models\Saleorderinvoiceline();
                foreach ($model as $value) {
                    $model2 = new \backend\models\Saleorderinvoiceline();
                    $count +=1;
                    $model2->invid = $session['invrecid'];
                    $model2->invline = $count;
                    $model2->partno = $value->custorderno;
                    $model2->description = $value->customername;
                    $model2->quantity = $value->quantity;
                    $model2->unitprice = $value->unitprice;
                    $model2->totalamount = $value->totalamount;
                    $model2->unit = $value->unit;
                    $model2->saleid = $value->saleid;
                    $model2->invoiceqty = $value->quantity;
          
                    $model2->save();
                }
                $model3 = new \backend\models\Invoicerefsale(); 
                $model3->invid =$session['invrecid'];
                $model3->saleid = $data;
                
                $model3->save();
                
              //cu  $x = $data;
           }
            
//            foreach ($_POST['sales'] as $data)
//            {
//                $model2 = new \backend\models\Invoicerefsale(); 
//                $model2->invid =$session['invid'];
//                $model2->saleid = $data;
//                
//                $model2->save();
//            }
         //   return $this->redirect(['saleorderinvoice/update','id'=>$session['invid']]);
           return $this->redirect(['saleorderinvoice/update','id'=>$session['invrecid']]);
           
           //  return $count;
            
        }else{
           // echo "ess";
        }
    }
//    public function addsale()
//    {
//            $session = new Session();
//            $session->open();
//            
//            if(isset($session['invid'])){
//               
//                return;
//            }else{
//              
//                return;
//            }
//      
//        if(!empty($_POST['sales']))
//        {
//            Invoicerefsale::deleteAll('invid = :invid',[':invid'=>$session['invid']]);
//            
//            foreach ($_POST['sales'] as $data)
//            {
//                $model2 = new \backend\models\Invoicerefsale(); 
//                $model2->invid =$session['invid'];
//                $model2->saleid = $data;
//                
//                $model2->save();
//            }
//            return $this->redirect(['saleorderinvoice/update','id'=>$session['invid']]);
//        }
//    }
    /**
     * Updates an existing Invoicesale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->recid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Invoicesale model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Invoicesale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invoicesale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoicesale::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionCreateinvid()
    {
         if (\yii::$app->request->isAjax) {
            $id = \yii::$app->request->post('invid');
            $session = new Session();
            $session->open();
            $session['invrecid'] = $id;
        }
    }
//    public function actionAddsale()
//    {
//            $session = new Session();
//            $session->open();
//      
//        if(!empty($_POST['sales']))
//        {
//            Invoicerefsale::deleteAll('invid = :invid',[':invid'=>$session['invid']]);
//            
//            foreach ($_POST['sales'] as $data)
//            {
//                $model2 = new \backend\models\Invoicerefsale(); 
//                $model2->invid =$session['invid'];
//                $model2->saleid = $data;
//                
//                $model2->save();
//            }
//            return $this->redirect(['saleorderinvoice/update','id'=>$session['invid']]);
//        }
//    }
}
