<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Sys_SysContinent".
 *
 * @property integer $Con_id
 * @property string $Con_nameTH
 * @property string $Con_nameEN
 * @property string $Con_description
 * @property string $ts_create
 */
class Continent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Sys_SysContinent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Con_id'], 'required'],
            [['Con_id'], 'integer'],
            [['Con_nameTH', 'Con_nameEN', 'Con_description'], 'string'],
            [['ts_create'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Con_id' => 'Con ID',
            'Con_nameTH' => 'Con Name Th',
            'Con_nameEN' => 'Con Name En',
            'Con_description' => 'Con Description',
            'ts_create' => 'Ts Create',
        ];
    }
}
