<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Saleorderline;

/**
 * SaleorderlineSearch represents the model behind the search form about `backend\models\Saleorderline`.
 */
class SaleorderlineSearch extends Saleorderline
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recid', 'saleid', 'saleline'], 'integer'],
            [['custorderno', 'customername', 'partno'], 'safe'],
            [['quantity', 'unitprice', 'totalamount'], 'number'],
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
        $query = Saleorderline::find();

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
//            'saleid' => $this->saleid,
//            'saleline' => $this->saleline,
//            'quantity' => $this->quantity,
//            'unitprice' => $this->unitprice,
//            'totalamount' => $this->totalamount,
//        ]);

        $query->orFilterWhere(['like', 'custorderno', $this->globalSearch])
            ->orFilterWhere(['like', 'customername', $this->globalSearch])
            ->orFilterWhere(['like', 'partno', $this->globalSearch]);

        return $dataProvider;
    }
}
