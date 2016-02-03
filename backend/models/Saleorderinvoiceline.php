<?php
namespace backend\models;
use yii\db\Query;

class Saleorderinvoiceline extends \common\models\Saleorderinvoiceline{
    public function Ordersum($so){
        $query = (new Query())->from('saleorderinvoiceline')->Where(['invid'=>$so]);
        $sum = $query->sum('quantity');
        return $sum;
    }
      public function Usdsum($so){
        $query = (new Query())->from('saleorderinvoiceline')->Where(['invid'=>$so]);
        $sum = $query->sum('totalamount');
        return $sum;
    }
      public function Thbsum($so){
        $query = (new Query())->from('saleorderinvoiceline')->Where(['invid'=>$so]);
        $sum = $query->sum('totalamount');
        return $sum;
    }
}

