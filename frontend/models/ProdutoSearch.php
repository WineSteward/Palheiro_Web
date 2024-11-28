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

    public function search($params, $query = null)
    {
        if ($query === null) {
            $query = Produto::find();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // Retorna os produtos todos se falhar
            return $dataProvider;
        }

        // filtros de pesquisa
        $query->andFilterWhere(['like', 'nome', $this->nome]);

        return $dataProvider;
    }
}