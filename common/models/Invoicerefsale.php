<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invoicerefsale".
 *
 * @property integer $recid
 * @property integer $invid
 * @property integer $saleid
 */
class Invoicerefsale extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoicerefsale';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invid', 'saleid'], 'integer']
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
            'saleid' => 'Saleid',
        ];
    }
    public function getSaleorder()
    {
        return $this->hasOne(\backend\models\Saleorder::className(), ['recid'=>'saleid']);
    }
}
