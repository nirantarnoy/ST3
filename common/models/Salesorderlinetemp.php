<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "salesorderlinetemp".
 *
 * @property integer $recid
 * @property integer $saleid
 * @property integer $saleline
 * @property string $session
 * @property string $custorderno
 * @property string $customername
 * @property double $quantity
 * @property double $unitprice
 * @property double $totalamount
 * @property string $partno
 */
class Salesorderlinetemp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salesorderlinetemp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['saleid'], 'required'],
            [['saleid', 'saleline'], 'integer'],
            [['session', 'custorderno', 'customername', 'partno'], 'string'],
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
            'session' => 'Session',
            'custorderno' => 'Custorderno',
            'customername' => 'Customername',
            'quantity' => 'Quantity',
            'unitprice' => 'Unitprice',
            'totalamount' => 'Totalamount',
            'partno' => 'Partno',
        ];
    }
}
