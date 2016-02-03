<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Udashboard;

/**
 * UdashboardSearch represents the model behind the search form about `backend\models\Udashboard`.
 */
class UdashboardSearch extends Udashboard
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recid', 'invcurrency', 'customerid'], 'integer'],
            [['invoiceno', 'invoicedate', 'createdate'], 'safe'],
            [['invcurrencyrate', 'disper', 'boxprc'], 'number'],
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
        $query = Udashboard::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'recid' => $this->recid,
            'invoicedate' => $this->invoicedate,
            'invcurrency' => $this->invcurrency,
            'invcurrencyrate' => $this->invcurrencyrate,
            'customerid' => $this->customerid,
            'createdate' => $this->createdate,
            'disper' => $this->disper,
            'boxprc' => $this->boxprc,
        ]);

        $query->andFilterWhere(['like', 'invoiceno', $this->invoiceno]);

        return $dataProvider;
    }
}
