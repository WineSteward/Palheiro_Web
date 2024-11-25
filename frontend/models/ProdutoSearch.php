<?php

namespace frontend\models;

use common\models\Produto;
use yii\data\ActiveDataProvider;

class ProdutoSearch extends Produto
{
    public function rules()
    {
        return [
            [['nome'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Produto::find();

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
        $query->andFilterWhere(['like', 'nome', $this->nome]);


        return $dataProvider;
    }
}