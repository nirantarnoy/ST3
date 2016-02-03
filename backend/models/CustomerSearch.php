<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `backend\models\Customer`.
 */
class CustomerSearch extends Customer
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Cus_id', 'Cus_Name', 'Cus_Nickname', 'Cus_Phone', 'Cus_Fax', 'Cus_Email', 'Cus_Website', 'Cus_Address', 'Cus_Contactname', 'Cus_Customeras', 'Cus_Country', 'Cus_Province', 'Cus_ContactPhone', 'Cus_Description', 'ts_create', 'ts_update', 'ts_name'], 'safe'],
            [['IsDelete'], 'integer'],
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
        $query = Customer::find();

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
//            'ts_create' => $this->ts_create,
//            'ts_update' => $this->ts_update,
//            'IsDelete' => $this->IsDelete,
//        ]);

        $query->orFilterWhere(['like', 'Cus_id', $this->globalSearch])
            ->orFilterWhere(['like', 'Cus_Name', $this->globalSearch])
            ->orFilterWhere(['like', 'Cus_Nickname', $this->globalSearch])
            ->orFilterWhere(['like', 'Cus_Phone', $this->globalSearch])
         //   ->andFilterWhere(['like', 'Cus_Fax', $this->Cus_Fax])
            ->orFilterWhere(['like', 'Cus_Email', $this->globalSearch])
            ->orFilterWhere(['like', 'Cus_Website', $this->globalSearch])
            ->orFilterWhere(['like', 'Cus_Address', $this->globalSearch])
            ->orFilterWhere(['like', 'Cus_Contactname', $this->globalSearch])
            ->orFilterWhere(['like', 'Cus_Customeras', $this->globalSearch])
            ->orFilterWhere(['like', 'Cus_Country', $this->globalSearch])
           // ->andFilterWhere(['like', 'Cus_Province', $this->Cus_Province])
//            ->andFilterWhere(['like', 'Cus_ContactPhone', $this->Cus_ContactPhone])
//            ->andFilterWhere(['like', 'Cus_Description', $this->Cus_Description])
            ->orFilterWhere(['like', 'ts_name', $this->globalSearch]);

        return $dataProvider;
    }
}
