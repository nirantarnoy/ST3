<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "salesorderline".
 *
 * @property integer $recid
 * @property integer $saleid
 * @property integer $saleline
 * @property string $custorderno
 * @property string $customername
 * @property double $quantity
 * @property double $unitprice
 * @property double $totalamount
 * @property string $partno
 * @property integer $unit
 */
class Salesorderline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salesorderline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['saleid'], 'required'],
            [['saleid', 'saleline', 'unit'], 'integer'],
            [['custorderno', 'customername', 'partno'], 'string'],
            [['quantity', 'unitprice', 'totalamount'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recid' => 'Recid',
            'saleid' => 'Saleid',
            'saleline' => 'Saleline',
            'custorderno' => 'Custorderno',
            'customername' => 'Customername',
            'quantity' => 'Quantity',
            'unitprice' => 'Unitprice',
            'totalamount' => 'Totalamount',
            'partno' => 'Partno',
            'unit' => 'Unit',
        ];
    }
}
