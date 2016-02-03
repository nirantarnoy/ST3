<?php
namespace backend\models;
use yii\db\Query;

class Saleorderline extends \common\models\Salesorderline{
    public $upfile;
    public function rules() {
       return [[['upfile'],'file']];
    }
     public function Ordersum($so){
        $query = (new Query())->from('salesorderline')->Where(['saleid'=>$so]);
        $sum = $query->sum('quantity');
        return $sum;
    }
      public function Usdsum($so){
        $query = (new Query())->from('salesorderline')->Where(['saleid'=>$so]);
        $sum = $query->sum('totalamount');
        return $sum;
    }
      public function Thbsum($so){
        $query = (new Query())->from('salesorderline')->Where(['saleid'=>$so]);
        $sum = $query->sum('totalamount');
        return $sum;
    }
}