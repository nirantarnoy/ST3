<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "salesorder".
 *
 * @property integer $recid
 * @property string $saleno
 * @property string $saledate
 * @property integer $customer
 * @property string $saleman
 * @property string $refno
 * @property string $description
 * @property string $shipdate
 * @property string $shipfrom
 * @property integer $shipto
 * @property string $paymentterm
 * @property integer $currency
 * @property double $currencyrate
 * @property string $createdate
 * @property string $createby
 */
class Salesorder extends \yii\db\ActiveRecord
{
    public $totalqty;
    public $totalamt;
    public $totalthb;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salesorder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['saleno'], 'required'],
            [['saleno', 'saleman', 'refno', 'description', 'shipfrom', 'paymentterm', 'createby'], 'string'],
            [['saledate', 'shipdate', 'createdate'], 'safe'],
            [['customer', 'shipto', 'currency'], 'integer'],
            [['currencyrate'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recid' => 'Recid',
            'saleno' => 'Saleno',
            'saledate' => 'Saledate',
            'customer' => 'Customer',
            'saleman' => 'Saleman',
            'refno' => 'Refno',
            'description' => 'Description',
            'shipdate' => 'Shipdate',
            'shipfrom' => 'Shipfrom',
            'shipto' => 'Shipto',
            'paymentterm' => 'Paymentterm',
            'currency' => 'Currency',
            'currencyrate' => 'Currencyrate',
            'createdate' => 'Createdate',
            'createby' => 'Createby',
            'totalqty' => 'Total quantity',
            'totalamt' => 'Total amount',
            'totalthb' => 'Total THB',
        ];
    }
}
