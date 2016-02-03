<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Invoicesale;

/**
 * InvoicesaleSearch represents the model behind the search form about `backend\models\Invoicesale`.
 */
class InvoicesaleSearch extends Invoicesale
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recid', 'shipto', 'currency'], 'integer'],
            [['saleno', 'saledate', 'saleman', 'refno', 'description', 'shipdate', 'shipfrom', 'paymentterm', 'createdate', 'createby'], 'safe'],
            [['currencyrate'], 'number'],
            [['customer'],'safe'],
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
        $query = Invoicesale::find();

        // add conditions that should always apply here
        $query->joinWith(['customername','salename']); // ชื่อ relation
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
         
        
        $dataProvider->sort->attributes['customer'] = [
            'asc' => ['Sys_SaleCustomer.Cus_Name' => SORT_ASC],
            'desc' => ['Sys_SaleCustomer.Cus_Name' => SORT_DESC],
        ];
           $dataProvider->sort->attributes['saleman'] = [
            'asc' => ['Sys_SaleData.Sale_Name' => SORT_ASC],
            'desc' => ['Sys_SaleData.Sale_Name' => SORT_DESC],
        ];
        
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'recid' => $this->recid,
            'saledate' => $this->saledate,
           // 'customer' => $this->customer,
            'shipdate' => $this->shipdate,
            'shipto' => $this->shipto,
            'currency' => $this->currency,
            'currencyrate' => $this->currencyrate,
            'createdate' => $this->createdate,
         
        ]);

        $query->andFilterWhere(['like', 'saleno', $this->saleno])
          //  ->andFilterWhere(['like', 'saleman', $this->saleman])
            ->andFilterWhere(['like', 'refno', $this->refno])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'shipfrom', $this->shipfrom])
            ->andFilterWhere(['like', 'paymentterm', $this->paymentterm])
            ->andFilterWhere(['like', 'Sys_SaleCustomer.Cus_Name', $this->customer])
            ->andFilterWhere(['like', 'Sys_SaleData.Sale_Name', $this->saleman])
         ;
         //   ->andFilterWhere(['like', 'createby', $this->createby]);

        return $dataProvider;
    }
}
