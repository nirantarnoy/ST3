<?php

namespace backend\controllers;

use Yii;
use backend\models\Customer;
use backend\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\web\Session;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $xmodel = [];
        $db = Yii::$app->db;
     //   $query = $db->createCommand('EXEC mytest @xid=27');
       $query = $db->createCommand('EXEC sp_company');
        $xec = $query->queryAll();
       
        foreach ($xec as $x){
         //   $xmodel['recid']=$x['recid'];
            $xmodel[$x['company_id']]=$x['company_name'];
        }
        
        $prov = new ArrayDataProvider([
            'allModels'=>$xec,
        ]);
        $modelx = $prov->getModels();
        
       // print_r($xmodel);
//        echo('<pre>');
//        var_dump($modelx);
//        echo('</pre>');
//       for($i=0;$i<count($modelx);$i++){
//           echo $modelx[$i]['recid'];
//           echo $modelx[$i]['saleno'];
//           echo $modelx[$i]['saledate'];
//       }
//       for ($i=0;$i <= $model->lenght;$i++){
//           echo $model[0]->recid;
//       }
       
     //   return ;
        
        $model = new Customer();
        $sale = new \backend\models\Saledata();
        $country = new \backend\models\Country();
        $province = new \backend\Models\Province();
        
        $updatecom =[];
        $updatesec =[];
        $updatedep =[];
        $updatesale =[];
        $n =0;
        $m =0;
            if($model->Cus_Customeras !=''){
                $dbcon = Yii::$app->db3;
                $res = $dbcon->createCommand('SELECT * FROM Sale_SaleData WHERE Sal_id='.$model->Cus_Customeras)->queryAll();
                foreach ($res as $res2){
                    $updatesale[$n]['recid'] = $res2['Sal_id'];
                    $updatesale[$n]['salename'] = $res2['Sal_name'];
                  //  $updatesale[$res2['Sal_id']]= $res2['Sal_name'];
                    $com = Yii::$app->db->createCommand('EXEC sp_company2 @param='.$res2['bch_id'])->queryAll();
                    foreach ($com as $comres){
                        $updatecom[$m]['recid']=$res2['bch_id'];
                      //  $updatecom[$m]['comname']=$comres['company_name'];
                      // $updatecom[$comres['company'_id']]=$comres['company_name'];
                    }
                  $updatesec[$n]['recid']=$res2['div_id'];
                  $updatedep[$n]['recid']=$res2['Sal_department'];
                 // echo $updatesec[$n]['recid'];return;
//                      $sec = Yii::$app->db->createCommand('EXEC sp_section2 @param='.$res2['div_id'])->queryAll();
//                    foreach ($sec as $secres){
//                        $updatesec[$m]['recid']=$secres['section_id'];
//                        $updatecom[$m]['secname']=$secres['section_name'];
//                        echo $secres['section_name'];return;
//                    }
                }
                
              
            }
        $secmodel = [];
        $secdb = Yii::$app->db->createCommand('EXEC sp_section2')->queryAll();
        foreach ($secdb as $secdbres){
            $secmodel[$secdbres['section_id']]=$secdbres['section_name'];
        }
         $depmodel = [];
        $depdb = Yii::$app->db->createCommand('EXEC sp_department2')->queryAll();
        foreach ($depdb as $depres){
            $depmodel[$depres['department_id']]=$depres['department_name'];
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Cus_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'sale'=>$sale,
                'country'=>$country,
                'province'=>$province,
                'xmodel'=>$xmodel,
                 'updatecom'=>$updatecom,
                 'updatesec'=>$updatesec,
                 'updatedep'=>$updatedep,
                 'secmodel'=>$secmodel,
                'depmodel'=>$depmodel,
            ]);
        }
    }

    public function actionShowsection($id){
        $connection = Yii::$app->db;
        $result = $connection->createCommand('EXEC sp_section @com_id='.$id)->queryAll();
        
        if (count($result)> 0) {
            echo "<option>-</option>";
            foreach ($result as $value) {
                $secname = $value['section_name'];
              
                $session = new Session();
                $session->open();
                
               // $session['shipto']= $value->Cus_Country;
                echo "<option value='" . $value['section_id'] . "'>$secname</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }
     public function actionShowdepartment($id){
        $connection = Yii::$app->db;
        $result = $connection->createCommand('EXEC sp_department @sec_id='.$id)->queryAll();
        
        if (count($result)> 0) {
            echo "<option>-</option>";
            foreach ($result as $value) {
                $secname = $value['department_name'];
              
                $session = new Session();
                $session->open();
                
               // $session['shipto']= $value->Cus_Country;
                echo "<option value='" . $value['department_id'] . "'>$secname</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }
    public function actionShowsale($id){
        $connection = Yii::$app->db;
        $result = $connection->createCommand('EXEC sp_salesData @dep_id='.$id)->queryAll();
       
        if (count($result)> 0) {
             echo "<option>-</option>";
            foreach ($result as $value) {
                $secname = $value['sraff_th'];
              
                $session = new Session();
                $session->open();
                
               // $session['shipto']= $value->Cus_Country;
                echo "<option value='" . $value['staff_id'] . "'>$secname</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }
    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $sale = new \backend\models\Saledata();
        $country = new \backend\models\Country();
        $province = new \backend\Models\Province();
        
    
        $updatecom =[];
        $updatesec =[];
        $updatedep =[];
        $updatesale =[];
        $n =0;
        $m =0;
            if($model->Cus_Customeras !=''){
                $dbcon = Yii::$app->db3;
                $res = $dbcon->createCommand('SELECT * FROM Sale_SaleData WHERE Sal_id='.$model->Cus_Customeras)->queryAll();
                foreach ($res as $res2){
                    $updatesale[$n]['recid'] = $res2['Sal_id'];
                    $updatesale[$n]['salename'] = $res2['Sal_name'];
                  //  $updatesale[$res2['Sal_id']]= $res2['Sal_name'];
                    $com = Yii::$app->db->createCommand('EXEC sp_company2 @param='.$res2['bch_id'])->queryAll();
                    foreach ($com as $comres){
                        $updatecom[$m]['recid']=$res2['bch_id'];
                      //  $updatecom[$m]['comname']=$comres['company_name'];
                      // $updatecom[$comres['company'_id']]=$comres['company_name'];
                    }
                  $updatesec[$n]['recid']=$res2['div_id'];
                  $updatedep[$n]['recid']=$res2['Sal_department'];
                 // echo $updatesec[$n]['recid'];return;
//                      $sec = Yii::$app->db->createCommand('EXEC sp_section2 @param='.$res2['div_id'])->queryAll();
//                    foreach ($sec as $secres){
//                        $updatesec[$m]['recid']=$secres['section_id'];
//                        $updatecom[$m]['secname']=$secres['section_name'];
//                        echo $secres['section_name'];return;
//                    }
                }
                
              
            }
      
        
        $xmodel = [];
        $db = Yii::$app->db;
     //   $query = $db->createCommand('EXEC mytest @xid=27');
       $query = $db->createCommand('EXEC sp_company');
        $xec = $query->queryAll();
       
        foreach ($xec as $x){
         //   $xmodel['recid']=$x['recid'];
            $xmodel[$x['company_id']]=$x['company_name'];
        }
        
        $prov = new ArrayDataProvider([
            'allModels'=>$xec,
        ]);
        $modelx = $prov->getModels();
        
        
        $secmodel = [];
        $secdb = Yii::$app->db->createCommand('EXEC sp_section2')->queryAll();
        foreach ($secdb as $secdbres){
            $secmodel[$secdbres['section_id']]=$secdbres['section_name'];
        }
         $depmodel = [];
        $depdb = Yii::$app->db->createCommand('EXEC sp_department2')->queryAll();
        foreach ($depdb as $depres){
            $depmodel[$depres['department_id']]=$depres['department_name'];
        }
        
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Cus_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                  'sale'=>$sale,
                'country'=>$country,
                'province'=>$province,
                 'xmodel'=>$xmodel,
                 'updatesale'=>$updatesale,
                 'updatecom'=>$updatecom,
                 'updatesec'=>$updatesec,
                 'updatedep'=>$updatedep,
                 'secmodel'=>$secmodel,
                'depmodel'=>$depmodel,
            ]);
        }
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
