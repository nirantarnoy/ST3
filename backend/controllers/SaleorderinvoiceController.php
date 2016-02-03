<?php

namespace backend\controllers;

use Yii;
use backend\models\Saleorder;
use backend\models\SaleorderinvoiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\Saleorderline;
use backend\models\SaleorderlineSearch;
use yii\data\Pagination;
use backend\models\Saleorderinvoice;
use backend\models\Invoicerefsale;
use yii\web\Session;

/**
 * SaleorderinvoiceController implements the CRUD actions for Saleorderinvoice model.
 */
class SaleorderinvoiceController extends Controller
{
     public function init() {
//        $session = new Session();
//        $session->open();
//        if (empty($_SESSION['userid'])) {
//            return $this->redirect('index.php?r=login');
//        }
    }  
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
     * Lists all Saleorderinvoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SaleorderinvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Saleorderinvoice model.
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
     * Creates a new Saleorderinvoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $searchModel = \backend\models\Saleorderinvoiceline::find()->where(['invid'=>0]);
       
        $model = new Saleorderinvoice();

        if ($model->load(Yii::$app->request->post()) ) {
            
            $chkcount = Saleorderinvoice::find()->where(['invoiceno'=>$_POST['Saleorderinvoice']['invoiceno']])->count();
          if($chkcount > 0) {
//                print_r($model->errors);
//                echo 'Not save';
                    $session = new Session();
                    $session->open();
                    $session->setFlash('modelerror','เลขที่ Invoice ซ้ำ');
                    return $this->render('create', [
                       'model' => $model,
                 'saleline' => $searchModel,
                 'rowcount'=>0,
                 'saleincluded'=>null,
                'saleincludedcount'=>0,
            ]);
               
               
                }
            
            
               $saledate = $_POST['Saleorderinvoice']['invoicedate'];
               $model->invoicedate =  date('d/M/Y H:i:s', strtotime($saledate));
               // $model->createby =$session['username'];
             if($model->save()){
                 
                  $uploaded = UploadedFile::getInstance($model, 'upfile');
                 $result=0;
//            if(!empty($uploaded))
//            {
//               
//                $upfiles = time().".".$uploaded->getExtension();
//                $uploaded->saveAs('../../uploads/'.$upfiles);
//                $handle = fopen('../../uploads/'.$upfiles, 'r');
//             
//              
//                $n = 0;
//                while (($fileop = fgetcsv($handle, 1000,","))!== false){
//                    if($n<1)
//                    {
//                        $n++;
//                        continue;
//                       
//                    }
//                         $model2 = new \backend\models\Saleorderinvoiceline();
//                         $model2->invid = $model->recid;
//                         $model2->invline = $fileop[0];
//                         $model2->partno=$fileop[1];
//                         $model2->description=iconv("TIS-620", "UTF-8", $fileop[2]);
//                         $model2->quantity=$fileop[3];
//                         $model2->unitprice=$fileop[4];
//                         $model2->totalamount=$fileop[5];
//                         $model2->unit=1;
//                         
//                  
//                         if($model2->save())
//                         {
//                             $result++;
//                         }
//                }
//                
//                fclose($handle);
//                 if($result >0)
//                 {
//                    $session = new \yii\web\Session();
//                        $session->open();
//                        $session->setFlash('msgsuccess','บันทึกรายการเรียบร้อย');
//                      return $this->redirect(['update', 'id' => $model->recid]);
//                 }
//             }
        } else {
           
        }
    }
     return $this->render('create', [
                'model' => $model,
                 'saleline' => $searchModel,
                 'rowcount'=>0,
                 'saleincluded'=>null,
                'saleincludedcount'=>0,
            ]);
    }

    /**
     * Updates an existing Saleorderinvoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateline(){
        if(\Yii::$app->request->isAjax){
            $id = \Yii::$app->request->post('recid');
            $qty = \Yii::$app->request->post('qty');
            
            $model = \backend\models\Saleorderinvoiceline::findOne(['recid'=>$id]);
            
           // $model->unitprice = $model->unitprice * $qty;
            $model->invoiceqty = $qty;
            $model->totalamount = $model->unitprice * $qty;
            if($model->save()){
                return "ok";
            }else{
                return "no";
            }
            
        }
    }
    public function actionRemoveall()
    {
         if (\yii::$app->request->isAjax) {
            $id = \yii::$app->request->post('id');
            $deldetail = \backend\models\Saleorderinvoiceline::deleteAll('invid = :invid',[':invid'=>$id]);
           if($deldetail){
                return $this->redirect(['update', 'id' => $id]);
           }
        }
    }
     public function actionRemoveline($id,$pid)
    {
        // if (\yii::$app->request->isAjax) {
          //  $id = \yii::$app->request->post('id');
            $deldetail = \backend\models\Saleorderinvoiceline::deleteAll('recid = :recid',[':recid'=>$id]);
           if($deldetail){
                return $this->redirect(['update', 'id' => $pid]);
           }
      //  }
    }
    public function actionUpdate($id)
    {
       $totalCount = \backend\models\Saleorderinvoiceline::find()->where(['invid'=>$id])->count();
       $saleincluded = \backend\models\Invoicerefsale::find()->where(['invid'=>$id])->all();
       $saleincludedcount = \backend\models\Invoicerefsale::find()->where(['invid'=>$id])->count();
         
    $pages = new Pagination([
      'totalCount' => $totalCount,
      'pageSize' => 20,
        
    ]);

     $searchModel = \backend\models\Saleorderinvoiceline::find()->where(['invid'=>$id])
      ->orderBy('recid')
      ->offset($pages->offset)
      ->limit($pages->limit)
      ->all();
         
         
        $model = $this->findModel($id);
        $count = 0;
        if ($model->load(Yii::$app->request->post())) {
             $saledate = $_POST['Saleorderinvoice']['invoicedate'];
               $model->invoicedate =  date('d/M/Y H:i:s', strtotime($saledate)); 
             if($model->save()){
                  $session = new \yii\web\Session();
                        $session->open();
                        $session->setFlash('msgsuccess','บันทึกรายการเรียบร้อย');
                      return $this->redirect(['update', 'id' => $model->recid]);
                 
//                  $uploaded = UploadedFile::getInstance($model, 'upfile');
//                  $result=0;
//                  
//                    $model2 = new \backend\models\Saleorderinvoiceline();
//                    $count +=1;
//                    $model2->invid = 179;
//                    $model2->invline = $count;
//                    $model2->partno = $value->custorderno;
//                    $model2->description = $value->customername;
//                    $model2->quantity = $value->quantity;
//                    $model2->unitprice = $value->unitprice;
//                    $model2->totalamount = $value->totalamount;
//                    $model2->unit = $value->unit;
//                    $model2->saleid = $value->saleid;
//                    $model2->invoiceqty = $value->quantity;
//          
//                    if($model2->save())
//                    {
//                        $result = 1;
//                    }
                 
//                 if($result >0)
//                 {
//                    $session = new \yii\web\Session();
//                        $session->open();
//                        $session->setFlash('msgsuccess','บันทึกรายการเรียบร้อย');
//                      return $this->redirect(['update', 'id' => $model->recid]);
//                 }
                 
                 
//            if(!empty($uploaded))
//            {
//               
//                $upfiles = time().".".$uploaded->getExtension();
//                $uploaded->saveAs('../../uploads/'.$upfiles);
//                
//                $handle = fopen('../../uploads/'.$upfiles, 'r');
//                $n = 0;
//                while (($fileop = fgetcsv($handle, 1000,","))!== false){
//                    if($n<1)
//                    {
//                        $n++;
//                        continue;
//                       
//                    }
//                         $model2 = new \backend\models\Saleorderinvoiceline();
//                         $model2->invid = $model->recid;
//                         $model2->invline = $fileop[0];
//                         $model2->partno=$fileop[1];
//                         $model2->description=$fileop[2];
//                         $model2->quantity=$fileop[3];
//                         $model2->unitprice=$fileop[4];
//                         $model2->totalamount=$fileop[5];
//                         $model2->unit=1;
//                         
//                  
//                         if($model2->save())
//                         {
//                             $result++;
//                         }
//                }
//                
//                fclose($handle);
//                 if($result >0)
//                 {
//                    $session = new \yii\web\Session();
//                        $session->open();
//                        $session->setFlash('msgsuccess','บันทึกรายการเรียบร้อย');
//                      return $this->redirect(['update', 'id' => $model->recid]);
//                 }
//                 
//               
//             }
        } else {
           
        }
        } else {
            return $this->render('update', [
                'model' => $model,
                'saleline' => $searchModel,
                'pages'=> $pages,
                'rowcount'=> $totalCount,
                'saleincluded'=> $saleincluded,
                'saleincludedcount'=>$saleincludedcount,
            ]);
        }
        
         return $this->render('update', [
                'model' => $model,
                'saleline' => $searchModel,
                'pages'=> $pages,
                'rowcount'=> $totalCount,
                'saleincluded'=> $saleincluded,
                'saleincludedcount'=>$saleincludedcount,
            ]);
    }

    /**
     * Deletes an existing Saleorderinvoice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    
    public function actionDelete($id)
    {
       if($this->findModel($id)->delete())
        {
           $deldetail = \backend\models\Saleorderinvoiceline::deleteAll('invid = :invid',[':invid'=>$id]);
           $deldetail2 = \backend\models\Invoicerefsale::deleteAll('invid = :invid',[':invid'=>$id]);
           if($deldetail){
                return $this->redirect(['index']);
           }
             return $this->redirect(['index']); 
        }
    }

    /**
     * Finds the Saleorderinvoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Saleorderinvoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Saleorderinvoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
