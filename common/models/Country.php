<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Sys_SysCountry".
 *
 * @property integer $Cry_id
 * @property integer $Con_id
 * @property string $Cry_nameTH
 * @property string $Cry_nameEN
 * @property string $Cry_description
 * @property string $ts_create
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Sys_SysCountry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Cry_id'], 'required'],
            [['Cry_id', 'Con_id'], 'integer'],
            [['Cry_nameTH', 'Cry_nameEN', 'Cry_description'], 'string'],
            [['ts_create'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Cry_id' => 'Cry ID',
            'Con_id' => 'Con ID',
            'Cry_nameTH' => 'Cry Name Th',
            'Cry_nameEN' => 'Cry Name En',
            'Cry_description' => 'Cry Description',
            'ts_create' => 'Ts Create',
        ];
    }
    public function getFullname()
    {
        return $this->Cry_nameTH." "."[".$this->Cry_nameEN."]";
    }
}
