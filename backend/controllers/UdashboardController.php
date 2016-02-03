<?php

namespace backend\controllers;

use Yii;
use backend\models\Udashboard;
use backend\models\UdashboardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\web\Cookie;

$session = new Session();
$session->open();


/**
 * UdashboardController implements the CRUD actions for Udashboard model.
 */
class UdashboardController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Udashboard models.
     * @return mixed
     */
    public function init() {
      
//        $_SESSION['userid'] = $_GET['LOGINNAME'];
//        if(isset($_SESSION['userid'])){
//            if(empty($_COOKIE['userid'])|| $_COOKIE['userid']=='' || !isset($_COOKIE['userid'])){
//                return $this->redirect('www.google.com');
//            }
//        }
    }
    public function actionIndex()
    {
       
        $searchModel = new UdashboardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         $countSaleorder = \backend\models\Saleorder::find()->count();
         $countInvoice = \backend\models\Saleorderinvoice::find()->count();
         
         $lastSale = \backend\models\Saleorder::find()->orderBy('createdate DESC')->limit(10)->all();
         $lastInv = \backend\models\Saleorderinvoice::find()->orderBy('createdate DESC')->limit(10)->all();
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'salecount'=>$countSaleorder,
            'invoicecount'=>$countInvoice,
            'lastsale'=>$lastSale,
            'lastinv'=>$lastInv,
        ]);
    }

    /**
     * Displays a single Udashboard model.
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
     * Creates a new Udashboard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Udashboard();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->recid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Udashboard model.
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
     * Deletes an existing Udashboard model.
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
     * Finds the Udashboard model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Udashboard the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Udashboard::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
