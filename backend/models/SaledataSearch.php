<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Saledata;

/**
 * SaledataSearch represents the model behind the search form about `backend\models\Saledata`.
 */
class SaledataSearch extends Saledata
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Sale_Code', 'Sale_Name', 'Sale_Lastname', 'Sale_Address', 'Sale_Contact', 'Sale_Email', 'Sale_Branch', 'Sale_Description', 'ts_create', 'ts_update', 'ts_name'], 'safe'],
            [['Sale_Province', 'IsDelete'], 'integer'],
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
        $query = Saledata::find();

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
//            'Sale_Province' => $this->Sale_Province,
//            'ts_create' => $this->ts_create,
//            'ts_update' => $this->ts_update,
//            'IsDelete' => $this->IsDelete,
//        ]);

        $query->orFilterWhere(['like', 'Sale_Code', $this->globalSearch])
            ->orFilterWhere(['like', 'Sale_Name', $this->globalSearch])
            ->orFilterWhere(['like', 'Sale_Lastname', $this->globalSearch])
            ->orFilterWhere(['like', 'Sale_Address', $this->globalSearch])
            ->orFilterWhere(['like', 'Sale_Contact', $this->globalSearch])
            ->orFilterWhere(['like', 'Sale_Email', $this->globalSearch])
            ->orFilterWhere(['like', 'Sale_Branch', $this->globalSearch])
            ->orFilterWhere(['like', 'Sale_Description', $this->globalSearch])
            ->orFilterWhere(['like', 'ts_name', $this->globalSearch]);

        return $dataProvider;
    }
}
