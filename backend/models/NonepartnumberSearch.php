<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Nonepartnumber;

/**
 * NonepartnumberSearch represents the model behind the search form about `backend\models\Nonepartnumber`.
 */
class NonepartnumberSearch extends Nonepartnumber
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recid'], 'integer'],
            [['partno','salerefid', 'description', 'createdate'], 'safe'],
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
        $query = Nonepartnumber::find();
        
        $query->joinWith('saleorder');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'recid' => $this->recid,
            //'salerefid' => $this->salerefid,
            'createdate' => $this->createdate,
        ]);

        $query->andFilterWhere(['like', 'partno', $this->partno])
            ->andFilterWhere(['like', 'description', $this->description])
             ->andFilterWhere(['like', 'salesorder.saleno', $this->salerefid]);

        return $dataProvider;
    }
}
