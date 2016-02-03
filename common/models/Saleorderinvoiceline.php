<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "saleorderinvoiceline".
 *
 * @property integer $recid
 * @property integer $invid
 * @property integer $invline
 * @property string $partno
 * @property string $description
 * @property double $quantity
 * @property double $unitprice
 * @property double $totalamount
 * @property integer $unit
 * @property integer $saleid
 * @property double $invoiceqty
 */
class Saleorderinvoiceline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'saleorderinvoiceline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invid', 'invline', 'unit', 'saleid'], 'integer'],
            [['partno', 'description'], 'string'],
            [['quantity', 'unitprice', 'totalamount', 'invoiceqty'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recid' => 'Recid',
            'invid' => 'Invid',
            'invline' => 'Invline',
            'partno' => 'Partno',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'unitprice' => 'Unitprice',
            'totalamount' => 'Totalamount',
            'unit' => 'Unit',
            'saleid' => 'Saleid',
            'invoiceqty' => 'Invoiceqty',
        ];
    }
}
