<?php

namespace frontend\controllers;

use common\models\Produto;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProdutoController extends \yii\web\Controller
{
    public function actionIndex($id = 2)
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

        return $this->render('index', [
            'produto' => $produto,
            'dataProvider' => $dataProvider,
        ]);
    }

}
