<?php

namespace frontend\controllers;

use common\models\Categoria;
use common\models\Produto;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProdutoController extends \yii\web\Controller
{

        /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup', 'shop', 'contact', 'faturas', 'encomendas', 'cupoes', 'carrinho', 'produto'],
                'rules' => [
                    [
                        'actions' => ['index', 'shop', 'contact', 'produto'],
                        'allow' => true,
                        'roles' => ['?','client'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


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
