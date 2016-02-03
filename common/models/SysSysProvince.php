<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Sys_SysProvince".
 *
 * @property integer $ProvinceId
 * @property string $ProvinceCode
 * @property string $ProvinceName
 * @property integer $GeoId
 */
class SysSysProvince extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Sys_SysProvince';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ProvinceId', 'ProvinceCode', 'ProvinceName', 'GeoId'], 'required'],
            [['ProvinceId', 'GeoId'], 'integer'],
            [['ProvinceCode', 'ProvinceName'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ProvinceId' => 'Province ID',
            'ProvinceCode' => 'Province Code',
            'ProvinceName' => 'Province Name',
            'GeoId' => 'Geo ID',
        ];
    }
}
