<?php

namespace frontend\controllers;

use common\models\Categoria;
use common\models\Produto;
use frontend\models\ProdutoSearch;
use Yii;
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


    public function actionIndex($categoria_nome = null)
    {
        $query = Produto::find();

        if ($categoria_nome !== null) {
            // Get the category based on the name
            $category = Categoria::find()->where(['nome' => $categoria_nome])->one();

            if ($category) {
                // Filter products by the found category's ID
                $query->andWhere(['categoria_id' => $category->id]);
            }
        }

        // aplica filtros do ProdutoSearch
        $produtoSearch = new ProdutoSearch();
        $dataProvider = $produtoSearch->search(Yii::$app->request->queryParams, $query);

        // Categorias para a sidebar
        $categorias = Categoria::find()->all();

        return $this->render('index', [
            'categorias' => $categorias,
            'produtoSearch' => $produtoSearch,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionShow($id)
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
