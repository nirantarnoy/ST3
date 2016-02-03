<?php
namespace backend\models;
use yii\db\ActiveRecord;
use yii\db\Expression;
use common\models\SaleData;
use yii\db\Query;


class Saleorder extends \common\models\Salesorder{
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
               ['upfile'=>'Upload Saleorder',]) ;
    }
    public function getCurrencyicon()
    {
        return $this->hasOne(Currency::className(), ['recid'=>'currency']);
    }
      public function getCustomers()
    {
        return $this->hasOne(\common\models\Customer::className(), ['Cus_id'=>'customer']);
    }
    
     public function getCustomername()
    {
        return $this->hasOne(\common\models\Customer::className(), ['Cus_id'=>'customer']);
    }
    public function getCurrencyname()
    {
        return $this->hasOne(\common\models\Currency::className(), ['recid'=>'currency']);
    }
    public function getShiptoname()
    {
        return $this->hasOne(\common\models\Country::className(), ['Cry_id'=>'shipto']);
    }
      public function getShipfromname()
    {
        return $this->hasOne(\common\models\Country::className(), ['Cry_id'=>'shipfrom']);
    }
   public function getSalename()
    {
        return $this->hasOne(Saledata::className(), ['Sale_Code'=>'saleman']);
    }
  
}

