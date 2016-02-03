<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dbusers".
 *
 * @property integer $recid
 * @property string $fname
 * @property string $lname
 * @property string $username
 * @property string $password
 * @property integer $groupid
 * @property string $createdate
 */
class Dbusers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dbusers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'username', 'password'], 'string'],
            [['groupid'], 'required'],
            [['groupid'], 'integer'],
            [['createdate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recid' => 'Recid',
            'fname' => 'Name',
            'lname' => 'Surname',
            'username' => 'Username',
            'password' => 'Password',
            'groupid' => 'Group',
            'createdate' => 'Createdate',
        ];
    }
}
