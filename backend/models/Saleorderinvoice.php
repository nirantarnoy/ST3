<?php
namespace backend\models;
use yii\db\ActiveRecord;


class Saleorderinvoice extends \common\models\Saleorderinvoice{
    public $upfile;
     public function behaviors() {
          $current_timestamp = date('Y-m-d H:i:s');
        return[
            'timestamp'=>[
                'class'=>  \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                ActiveRecord::EVENT_BEFORE_INSERT=>'createdate',
                ],
                'value'=> $current_timestamp,
            ]
        ];
    }
     public function rules() {
        
       return array_merge(parent::rules(),[[['upfile'],'file']]) ;
    }
    public function attributeLabels() {
       return array_merge(parent::attributeLabels(),
               ['upfile'=>'Upload Invoice',]) ;
    }
    public function getCurrencyicon()
    {
        return $this->hasOne(\common\models\Currency::className(), ['recid'=>'invcurrency']);
    }
     public function getCurrencyname()
    {
        return $this->hasOne(\common\models\Currency::className(), ['recid'=>'invcurrency']);
    }
      public function getCustomername()
    {
        return $this->hasOne(\common\models\Customer::className(), ['Cus_id'=>'customerid']);
    }
}

