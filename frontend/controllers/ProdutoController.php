<?php

namespace frontend\controllers;

use common\models\Categoria;
use common\models\Produto;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProdutoController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $produtos = Produto::find()->all();
        $categorias = Categoria::find()->all();

        return $this->render('index',[
            'produtos' => $produtos,
            'categorias' => $categorias,
        ]);
    }

    public function actionShow($id = 2)
    {

        $produto = Produto::findOne($id);

        $dataProvider = new ActiveDataProvider([
            //'query' => $produto->getImages(),
            'query' => $produto->getMarca(),
            'query' => $produto->getCategoria(),
            'query' => $produto->getIva(),

            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        if (!$produto) {
            throw new NotFoundHttpException('The requested produto does not exist.');
        }

        return $this->render('show', [
            'produto' => $produto,
            'dataProvider' => $dataProvider,
        ]);
    }

}
