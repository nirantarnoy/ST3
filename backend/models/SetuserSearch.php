<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Setuser;

/**
 * SetuserSearch represents the model behind the search form about `backend\models\Setuser`.
 */
class SetuserSearch extends Setuser
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recid', 'groupid'], 'integer'],
            [['fname', 'lname', 'username', 'password', 'createdate'], 'safe'],
            [['globalSearch'],'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Setuser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        $query->andFilterWhere([
//            'recid' => $this->recid,
//            'groupid' => $this->groupid,
//            'createdate' => $this->createdate,
//        ]);

        $query->orFilterWhere(['like', 'fname', $this->globalSearch])
            ->orFilterWhere(['like', 'lname', $this->globalSearch])
            ->orFilterWhere(['like', 'username', $this->globalSearch])
            ->orFilterWhere(['like', 'password', $this->globalSearch]);

        return $dataProvider;
    }
}
