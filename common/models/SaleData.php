<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Sys_SaleData".
 *
 * @property string $Sale_Code
 * @property string $Sale_Name
 * @property string $Sale_Lastname
 * @property string $Sale_Address
 * @property integer $Sale_Province
 * @property string $Sale_Contact
 * @property string $Sale_Email
 * @property string $Sale_Branch
 * @property string $Sale_Description
 * @property string $ts_create
 * @property string $ts_update
 * @property string $ts_name
 * @property integer $IsDelete
 */
class SaleData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Sys_SaleData';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Sale_Code'], 'required'],
            [['Sale_Code', 'Sale_Name', 'Sale_Lastname', 'Sale_Address', 'Sale_Contact', 'Sale_Email', 'Sale_Branch', 'Sale_Description', 'ts_name'], 'string'],
            [['Sale_Province', 'IsDelete'], 'integer'],
            [['ts_create', 'ts_update'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Sale_Code' => 'Sale  Code',
            'Sale_Name' => 'Sale  Name',
            'Sale_Lastname' => 'Sale  Lastname',
            'Sale_Address' => 'Sale  Address',
            'Sale_Province' => 'Sale  Province',
            'Sale_Contact' => 'Sale  Contact',
            'Sale_Email' => 'Sale  Email',
            'Sale_Branch' => 'Sale  Branch',
            'Sale_Description' => 'Sale  Description',
            'ts_create' => 'Ts Create',
            'ts_update' => 'Ts Update',
            'ts_name' => 'Ts Name',
            'IsDelete' => 'Is Delete',
        ];
    }
    public function getFullname(){
        return $this->Sale_Name." ".$this->Sale_Lastname;
    }
}
