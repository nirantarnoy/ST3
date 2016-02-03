<?php
namespace backend\models;
use yii\base\Model;
class Mylogin extends \yii\base\Model{
    public $username;
    public $password;
    
    public function rules() {
       return [
           [['username','password'],'required'],
           [['username','password'],'string'],
       ];
    }
    public function attributeLabels() {
        return[
            'username'=>'username',
            'password'=>'password',
        ];
    }
    public function login()
    {
        $model = new Setuser();
        if($model->username == $this->username && $model->password == $this->password)
        {
            return $model;
        }
        
    }
}

