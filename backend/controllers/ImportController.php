<?php
namespace backend\controllers;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Session;

class ImportController extends Controller{
     public function init() {
//        $session = new Session();
//        $session->open();
//        if (empty($_SESSION['userid'])) {
//            return $this->redirect('index.php?r=login');
//        }
    }  
    public function actionIndex()
    {
        $model = new \backend\models\Saleorderline();
        return $this->render('index',['model'=>$model,]);
    }
    public function actionUpload(){
        $model = new \backend\models\Saleorderline();
        if(\Yii::$app->request->post()){
            
            $uploaded = UploadedFile::getInstance($model, 'upfile');
            if(!empty($uploaded))
            {
                $upfiles = time().".".$uploaded->getExtension();
               // $uploaded->saveAs('../../uploads/'.$upfiles);
                
                $handle = fopen('../../uploads/'.$upfiles, 'r');
                while (($fileop = fgetcsv($handle, 1000,","))!== false){
                         $model = new \backend\models\Saleorderline();
                         $model->saleid = 'SO0001';
                         $model->saleline = $fileop[0];
                         $model->partno=$fileop[1];
                          
                        //  echo $name."<BR />";
                         // $age = $fileop[1];
                          //$location = $fileop[2];
                         //print_r($fileop);exit();
//                        $sql = "INSERT INTO details(name, age, location) VALUES ('$name', '$age', '$location')";
//                        $query = Yii::$app->db->createCommand($sql)->execute();
               
                          
                          $model->save();
                }
                
                fclose($handle);
            }
        }
    }
}

