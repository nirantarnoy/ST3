<?php
namespace backend\controllers;
use backend\models\Setuser;
use yii\web\Session;

class LoginController extends \yii\web\Controller{
   
    public function actionIndex(){
        $this->layout = 'mylayout';
        $model = new \backend\models\Mylogin();
        return $this->render('index',['model'=>$model]);
    }
      public function actionSignin(){
          if(!empty($_POST)){
              $count = \common\models\Dbusers::find()->where(['username'=>$_POST['Mylogin']['username'],'password'=>$_POST['Mylogin']['password']])->count();
              $query = \common\models\Dbusers::find()->where(['username'=>$_POST['Mylogin']['username'],'password'=>$_POST['Mylogin']['password']])->one();
              
              if($count<=0)
           {
                $this->layout = 'mylayout';
                $userlogin = new \backend\models\Mylogin();
                $session=new Session();
                $session->open();
                $session->setFlash('msg','Username or password incorect');
          
         
                return $this->render('index',['model'=>$userlogin]);
           }
           else{
                $userlogin = new \backend\models\Mylogin();
                $session=new Session();
                $session->open();
               $session['userid'] =  $query->recid;
               $session['username'] = $query->fname;
                return $this->redirect(['/saleorder/index']);
           }
              
          }
    }
    public function actionLogout()
    {
        if(isset($_SESSION['userid'])){
            $session = new Session();
            $session->remove('userid');
            $session->remove('username');
            $session->remove('groupid');
        }
        
     //  return $this->redirect('index.php?r=login');
      return $this->redirect('http://stsoftware.strfactory.com/');
    }
}

