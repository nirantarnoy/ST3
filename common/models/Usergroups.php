<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usergroups".
 *
 * @property integer $recid
 * @property string $groupname
 * @property string $description
 * @property string $createdate
 */
class Usergroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usergroups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groupname', 'description'], 'string'],
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
            'groupname' => 'Groupname',
            'description' => 'Description',
            'createdate' => 'Createdate',
        ];
    }
}
