<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\Session;

$session = new \yii\web\Session();
$session->open();
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

//$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<div style=" width: 300px;height: auto;position: absolute;top:30px;bottom: 0;left: 0;right: 0;margin: auto;padding: 5px;">
  
    <div style="text-align: center;padding: 15px;">
        <div class="row pull-left">
            <div class="col-sm-4">
                 <img src="../../uploads/icon/logo.png">
              <!--<img src="C:\\inetpub\\wwwroot\\yii2-st\\uploads\\icon\\logo.png">-->
            </div>
             <div class="col-sm-8">
                <H3>System Login</h3>
            </div>
        </div>
       
    </div>
    <!-- /.login-logo -->
    <br />
    <div>
        <p class="login-box-msg">Sign in for start your application</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form','action'=>'index.php?r=login/signin']); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
 <?php // if(!empty($session->getFlash('msg'))):?>
<?php if($session->getFlash('msg')):?>

    <p style="color: red;"><strong>Login Fail! </strong><?= $session->getFlash('msg');?>.</p>
 
  
    <?php endif;?>
        <div class="row">
<!--            <div class="col-xs-8">
                <?php //echo $form->field($model, 'rememberMe')->checkbox() ?>
            </div>-->
            <!-- /.col -->
            <div class="col-xs-4">
                 
                <?= Html::submitButton('Log in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

</div><!-- /.login-box -->
</div>
<div class="xx">
    <p>My name is niran </p>
</div>