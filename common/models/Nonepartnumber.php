<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nonepartnumber".
 *
 * @property integer $recid
 * @property string $partno
 * @property string $description
 * @property integer $salerefid
 * @property string $createdate
 */
class Nonepartnumber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nonepartnumber';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partno', 'description'], 'string'],
            [['salerefid'], 'integer'],
            [['createdate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recid' => 'Recid',
            'partno' => 'Partno',
            'description' => 'Description',
            'salerefid' => 'Salerefid',
            'createdate' => 'Createdate',
        ];
    }
    public function getSaleorder(){
        return $this->hasOne(\backend\models\Saleorder::className(),['recid'=>'salerefid']);
    }
}
