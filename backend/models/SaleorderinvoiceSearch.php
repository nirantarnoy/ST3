<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Saleorderinvoice;

/**
 * SaleorderinvoiceSearch represents the model behind the search form about `backend\models\Saleorderinvoice`.
 */
class SaleorderinvoiceSearch extends Saleorderinvoice
{
    public  $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recid', 'invcurrency', 'customerid'], 'integer'],
            [['invoiceno', 'invoicedate', 'createdate'], 'safe'],
            [['invcurrencyrate'], 'number'],
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
        $query = Saleorderinvoice::find();

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
//            'invoicedate' => $this->invoicedate,
//            'invcurrency' => $this->invcurrency,
//            'invcurrencyrate' => $this->invcurrencyrate,
//            'customerid' => $this->customerid,
//            'createdate' => $this->createdate,
//        ]);

        $query->orFilterWhere(['like', 'invoiceno', $this->globalSearch]);

        return $dataProvider;
    }
}
