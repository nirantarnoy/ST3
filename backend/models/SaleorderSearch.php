<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Saleorder;

/**
 * SaleorderSearch represents the model behind the search form about `backend\models\Saleorder`.
 */
class SaleorderSearch extends Saleorder
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recid'], 'integer'],
            [['saleno', 'saledate', 'customer', 'saleman', 'refno', 'description', 'shipdate', 'shipfrom', 'shipto', 'paymentterm', 'currency', 'createdate'], 'safe'],
            [['currencyrate'], 'number'],
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
        $query = Saleorder::find();

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
//            'saledate' => $this->saledate,
//            'shipdate' => $this->shipdate,
//            'currencyrate' => $this->currencyrate,
//            'createdate' => $this->createdate,
//        ]);

        $query->orFilterWhere(['like', 'saleno', $this->globalSearch])
            ->orFilterWhere(['like', 'customer', $this->globalSearch])
            ->orFilterWhere(['like', 'saleman', $this->globalSearch])
            ->orFilterWhere(['like', 'refno', $this->globalSearch])
            ->orFilterWhere(['like', 'description', $this->globalSearch])
            ->orFilterWhere(['like', 'shipfrom', $this->globalSearch])
            ->orFilterWhere(['like', 'shipto', $this->globalSearch])
            ->orFilterWhere(['like', 'paymentterm', $this->globalSearch])
            ->orFilterWhere(['like', 'currency', $this->globalSearch]);

        return $dataProvider;
    }
}
