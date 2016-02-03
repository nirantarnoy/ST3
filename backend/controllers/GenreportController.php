<?php

namespace backend\controllers;

use Yii;
use backend\models\Genreport;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GenreportController implements the CRUD actions for Genreport model.
 */
class GenreportController extends Controller
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
     * Lists all Genreport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Genreport::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Genreport model.
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
     * Creates a new Genreport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Genreport();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Sale_Code]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Genreport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Sale_Code]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Genreport model.
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
     * Finds the Genreport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Genreport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Genreport::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionGenpdf(){
      $execreport = Yii::getAlias('@execreportPath').'\crexport\crexport.exe -U sa -P Tamakogi2012 -S st -D ST_DATA -F '.Yii::getAlias('@execreportPath').'\crexport\rpt_invoicesumbysale.rpt -O '.Yii::getAlias('@execreportPath').'\uploads\temp_report\x0x.pdf';
     // exec('C://crexport/crexport -U sa -P Tamakogi2012 -S st -D ST_DATA -F C://crexport/inv.rpt -O C://crexport/x0x.pdf');
     // exec('C:\\crexport\\crexport -U sa -P Tamakogi2012 -S st -D ST_DATA -F C:\\crexport\\rpt_saleorderyearbysale.rpt -O D:\\XAMPP\\htdocs\\st\\uploads\\temp_report\\x0x.pdf');
     exec($execreport,$res); 
     
     //echo $execreport;
     //print_r($res);
     
      return $this->redirect('../../uploads/temp_report/x0x.pdf');
      
    }
}
