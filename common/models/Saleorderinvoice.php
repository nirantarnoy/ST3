<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "saleorderinvoice".
 *
 * @property integer $recid
 * @property string $invoiceno
 * @property string $invoicedate
 * @property integer $invcurrency
 * @property double $invcurrencyrate
 * @property integer $customerid
 * @property string $createdate
 * @property double $disper
 * @property double $boxprc
 * @property string $createby
 */
class Saleorderinvoice extends \yii\db\ActiveRecord
{
    public $totalamt;
    public $totalqty;
    public $totalthb;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'saleorderinvoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoiceno'], 'required'],
            [['invoiceno', 'createby'], 'string'],
            [['invoicedate', 'createdate'], 'safe'],
            [['invcurrency', 'customerid'], 'integer'],
            [['invcurrencyrate', 'disper', 'boxprc'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recid' => 'Recid',
            'invoiceno' => 'Invoiceno',
            'invoicedate' => 'Invoicedate',
            'invcurrency' => 'Invcurrency',
            'invcurrencyrate' => 'Invcurrencyrate',
            'customerid' => 'Customerid',
            'createdate' => 'Createdate',
            'disper' => 'Disper',
            'boxprc' => 'Boxprc',
            'createby' => 'Createby',
            'totalqty'=>'Total quantity',
            'totalamt'=>'Total amount',
            'totalthb' => 'Total THB',
        ];
    }
}
