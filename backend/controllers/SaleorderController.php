<?php

namespace backend\controllers;

use Yii;
use backend\models\Saleorder;
use backend\models\SaleorderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\Saleorderline;
use backend\models\SaleorderlineSearch;
use yii\data\Pagination;
use yii\web\Session;
use backend\models\Customer;
use yii\data\ArrayDataProvider;
$session = new Session();
$session->open();

/**
 * SaleorderController implements the CRUD actions for Saleorder model.
 */
class SaleorderController extends Controller {

    public function init() {
//        $session = new Session();
//        $session->open();
//        if (empty($_SESSION['userid'])) {
//            return $this->redirect('index.php?r=login');
//        }
    }

    public function behaviors() {
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
     * Lists all Saleorder models.
     * @return mixed
     */
    public function actionIndex() {
       
        $searchModel = new SaleorderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Saleorder model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }
    public function actionCheckunique($so){
        $count = Saleorder::find()->where(['saleno'=>$so])->count();
        return $count;
    }

    public function actionShowlist($id) {
        $count = Customer::find()->where(['Cus_id' => $id])->count();
        $model = Customer::find()->where(['Cus_id' => $id])->all();

        if ($count > 0) {
            foreach ($model as $value) {
                $xcount = \backend\models\Saledata::find()->where(['Sale_Code' => $value->Cus_Customeras])->count();
               $sales = \backend\models\Saledata::find()->where(['Sale_Code' => $value->Cus_Customeras])->all();
                $fullname = '';
                
                foreach ($sales as $data) {
                    $fullname = $data->Sale_Name . " " . $data->Sale_Lastname;
                }
                $session = new Session();
                $session->open();
                if($xcount>0){
                $session['salecode']= $value->Cus_Customeras;
                }
                else{
                     $session['salecode']= null;
                }
                echo "<option value='" . $value->Cus_Customeras . "'>$fullname</option>";
              //echo "<option value='100'>$fullname</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }

    public function actionShowlist2($id) {
        $count = Customer::find()->where(['Cus_id' => $id])->count();
        $model = Customer::find()->where(['Cus_id' => $id])->all();

        if ($count > 0) {
            foreach ($model as $value) {
                $contry = \backend\models\Country::find()->where(['Cry_id' => $value->Cus_Country])->all();
                $fullname2 = '';
                foreach ($contry as $data2) {
                    $fullname2 = $data2->Cry_nameEN . " [" . $data2->Cry_nameTH . "]";
                }
                $session = new Session();
                $session->open();
                
                $session['shipto']= $value->Cus_Country;
                echo "<option value='" . $value->Cus_Country . "'>$fullname2</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }

    public function actionShowlist3($id) {

        $contry = \backend\models\Country::find()->where(['Cry_nameTH' => 'ไทย'])->all();
        //$contry = \backend\models\Country::find()->all();
        $fullname2 = '';
        $recid = 0;
        $name = '';
        foreach ($contry as $data2) {
            $recid = $data2->Cry_id;
            $fullname2 = $data2->Cry_nameEN . " [" . $data2->Cry_nameTH . "]";
            $name = $data2->Cry_nameTH;
        }
        if ($name == 'ไทย') {
            echo "<option value='" . $recid . "' selected=true>$fullname2</option>";
        } else {
            echo "<option value='" . $recid . "'>$fullname2</option>";
        }
    }

    /**
     * Creates a new Saleorder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function Validpart($partno){
       
        $x = Yii::$app->db2->createCommand("SELECT * FROM production_data WHERE part='$partno'")->queryAll();
        //echo count($x);
        return count($x);
    }
  
    public function actionCreate() {
        
       
        $session = new Session();
        $session->open();
//        Yii::$app->params['uploadPath'] = realpath(Yii::$app->basePath) . '\\uploads\\';
        $searchModel = Saleorderline::find()->where(['saleid' => 0]);
        $model = new Saleorder();
        
        if ($model->load(Yii::$app->request->post())) {
            
            
             $chkcount = Saleorder::find()->where(['saleno'=>$_POST['Saleorder']['saleno']])->count();
          if($chkcount > 0) {
//                print_r($model->errors);
//                echo 'Not save';
                    $session = new Session();
                    $session->open();
                    $session->setFlash('modelerror','เลขที่ SO ซ้ำ');
                    return $this->render('create', [
                    'model' => $model,
                    'saleline' => $searchModel,
                    'rowcount' => 0,
            ]);
               
               
                }
            
            
            $saledate = $_POST['Saleorder']['saledate'];
            $shipdate = $_POST['Saleorder']['shipdate'];
           
            $model->saledate = date('d/M/Y H:i:s', strtotime($saledate));
            $model->shipdate = date('d/M/Y H:i:s', strtotime($shipdate));
//            $model->shipfrom = $_POST['Saleorder']['shipfrom'];
            $model->shipto = isset($session['shipto'])?$session['shipto']:'';
            $model->saleman = isset($session['salecode'])?$session['salecode']:NULL;
            $model->createby =$session['userid'];
           // $model->saleman = $_POST['saleman'];
         
            //echo $session['salecode'];
           // return;
            
            if ($model->save()) {

                $uploaded = UploadedFile::getInstance($model, 'upfile');
                $result = 0;
                if (!empty($uploaded)) {

                    $upfiles = time() . "." . $uploaded->getExtension();

                    if ($uploaded->saveAs('../../uploads/' . $upfiles)) {
                        $handle = fopen('../../uploads/' . $upfiles, 'r');
                    }


//            $uploaded->saveAs(Yii::$app->params['uploadPath'].$upfiles);
//                
//                $handle = fopen(Yii::$app->params['uploadPath'].$upfiles, 'r');
                    $n = 0;
                    $nonepartcount = 0;
                   setlocale (LC_ALL,'en_US.UTF-8');
                    while (($fileop = fgetcsv($handle, 1000, ",")) !== false) {
                        if ($n < 1) {
                            $n++;
                            continue;
                        }
                        
                        if($this->Validpart($fileop[1])<=0){
                            $nonepartcount +=1;
                            $nonepart = new \backend\models\Nonepartnumber();
                            
                            $nonepart->partno = $fileop[1];
                            $nonepart->description = iconv("TIS-620", "UTF-8", $fileop[2]);
                            $nonepart->salerefid = $model->recid;
                            $nonepart->createdate = date('Y-m-d H:i:s');
                            $nonepart->save();
//                            $nonepart->partno = '12';
//                            $nonepart->description = 'xxxx';
//                            $nonepart->salerefid = $model->recid;
//                            $nonepart->createdate = date('Y-m-d H:i:s');
//                            $nonepart->save();
                            
                           
                        }
                        
                        
                        $model2 = new \backend\models\Saleorderline();
                        $model2->saleid = $model->recid;
                        $model2->saleline = $fileop[0];
                         $model2->partno=$fileop[1];
                        $model2->custorderno = iconv("TIS-620", "UTF-8", $fileop[2]);
                        $model2->customername = iconv("TIS-620", "UTF-8", $fileop[3]);
                        $model2->quantity = $fileop[4];
                        $model2->unitprice = $fileop[5];
                        $model2->totalamount = $fileop[6];
                        $model2->unit = 1;
                        
//                         $model2->partno=$fileop[7];
                        //  echo $name."<BR />";
                        // $age = $fileop[1];
                        //$location = $fileop[2];
                        //print_r($fileop);exit();
//                        $sql = "INSERT INTO details(name, age, location) VALUES ('$name', '$age', '$location')";
//                        $query = Yii::$app->db->createCommand($sql)->execute();
                            
                     
//                      iconv("TIS-620", "UTF-8", $fileop[2]);
                    //   return;

                        if ($model2->save()) {
                            $result++;
                        }
                    }
                    
                    if($nonepartcount >0)
                    {
                        $result = 0;
                        Saleorderline::deleteAll(['saleid'=>$model->recid]);
                        //Saleorder::deleteAll(['recid'=>$model->recid]);
                      //  echo "OKKK";
                      //  return;
                    }

                    fclose($handle);
                    unlink('../../uploads/' . $upfiles);
                    if ($result > 0) {
                        $session = new \yii\web\Session();
                        $session->open();
                        $session->setFlash('msgsuccess','บันทึกรายการเรียบร้อย');
                        return $this->redirect(['update', 'id' => $model->recid]);
                    }  else {
                         $session = new \yii\web\Session();
                        $session->open();
                        $session->setFlash('msgerror','บันทึกรายการไม่สำเร็จ พบข้อผิดพลาดขณะอัพโหลดข้อมูล');
                        return $this->redirect(['update', 'id' => $model->recid]);
                    }
                }
            } 
          
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'saleline' => $searchModel,
                        'rowcount' => 0,
            ]);
        }
    }

   
    public function actionUpdate($id) {
        $session = new Session();
        $session->open();
        $totalCount = Saleorderline::find()->where(['saleid' => $id])->count();

        $pages = new Pagination([
            'totalCount' => $totalCount,
            'pageSize' => 20,
        ]);

        $searchModel = Saleorderline::find()->where(['saleid' => $id])
                ->orderBy('recid')
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();


        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $saledate = $_POST['Saleorder']['saledate'];
            $shipdate = $_POST['Saleorder']['shipdate'];
            $model->saledate = date('d/M/Y H:i:s', strtotime($saledate));
            $model->shipdate = date('d/M/Y H:i:s', strtotime($shipdate));
//         $model->shipfrom = $_POST['Saleorder']['shipfrom'];
               $model->shipto = isset($session['shipto'])?$session['shipto']:'';
                $model->saleman = isset($session['salecode'])?$session['salecode']:NULL;
               $model->createby = $session['userid'];
            if ($model->save()) {
                $uploaded = UploadedFile::getInstance($model, 'upfile');
                $result = 0;
                if (!empty($uploaded)) {
                    
//                    print_r($uploaded);
//                    return;
                    
                    $deldetail = Saleorderline::deleteAll('saleid = :saleid', [':saleid' => $id]);
                    $upfiles = time() . "." . $uploaded->getExtension();
                    $uploaded->saveAs('../../uploads/'.$upfiles);
//                    // $uploaded->saveAs();
//                  //  move_uploaded_file($uploaded, '../../uploads/' . $upfiles);
//
                   $handle = fopen('../../uploads/' . $upfiles, 'r');
//                  $handle = fopen($uploaded, 'r');
                    $n = 0;
                    
                     setlocale (LC_ALL,'en_US.UTF-8');
                    while (($fileop = fgetcsv($handle, 1000, ",")) !== false) {
                        if ($n < 1) {
                            $n++;
                            continue;
                        }
                       $model2 = new \backend\models\Saleorderline();
                        $model2->saleid = $model->recid;
                        $model2->saleline = $fileop[0];
                         $model2->partno=$fileop[1];
                        $model2->custorderno = iconv("TIS-620", "UTF-8", $fileop[2]);
                        $model2->customername = iconv("TIS-620", "UTF-8", $fileop[3]);
                        $model2->quantity = $fileop[4];
                        $model2->unitprice = $fileop[5];
                        $model2->totalamount = $fileop[6];
                        $model2->unit = 1;
//                         $model2->partno=$fileop[7];
                        //  echo $name."<BR />";
                        // $age = $fileop[1];
                        //$location = $fileop[2];
                        //print_r($fileop);exit();
//                        $sql = "INSERT INTO details(name, age, location) VALUES ('$name', '$age', '$location')";
//                        $query = Yii::$app->db->createCommand($sql)->execute();


                        if ($model2->save()) {
                            $result++;
                        }
                    }

                    fclose($handle);
                    unlink('../../uploads/'.$upfiles);
                    if ($result > 0) {
                        $session = new \yii\web\Session();
                        $session->open();
                        $session->setFlash('msgsuccess','บันทึกรายการเรียบร้อย');
                        return $this->redirect(['update', 'id' => $model->recid]);
                    }
                }
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'saleline' => $searchModel,
                        'pages' => $pages,
                        'rowcount' => $totalCount,
            ]);
        }
        return $this->render('update', [
                    'model' => $model,
                    'saleline' => $searchModel,
                    'pages' => $pages,
                    'rowcount' => $totalCount,
        ]);
    }

    /**
     * Deletes an existing Saleorder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRemoveall() {
        if (\yii::$app->request->isAjax) {
            $id = \yii::$app->request->post('id');
            $deldetail = Saleorderline::deleteAll('saleid = :saleid', [':saleid' => $id]);
            if ($deldetail) {
                return $this->redirect(['update', 'id' => $id]);
            }
        }
    }

    public function actionRemoveline($id, $pid) {

        $deldetail = \backend\models\Saleorderline::deleteAll('recid = :recid', [':recid' => $id]);
        if ($deldetail) {
            return $this->redirect(['update', 'id' => $pid]);
        }
    }

    public function actionDelete($id) {
        if ($this->findModel($id)->delete()) {
            $deldetail = Saleorderline::deleteAll('saleid = :saleid', [':saleid' => $id]);
            if ($deldetail) {
                return $this->redirect(['index']);
            }
            return $this->redirect(['index']);
        }
    }

    public function actionAddline() {

        return $this->render('index');
    }
    
    public function actionGeninvoice($id){
        
    }

    /**
     * Finds the Saleorder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Saleorder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Saleorder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
