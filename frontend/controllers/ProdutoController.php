<?php

namespace frontend\controllers;

use common\models\Carrinho;
use common\models\Categoria;
use common\models\Linhacarrinho;
use common\models\Produto;
use common\models\Userprofile;
use frontend\models\ProdutoSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
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
        $produtoSearch = new ProdutoSearch();
            
        $produtoSearch->load(Yii::$app->request->queryParams);

        $query = Produto::find();
            
        if ($produtoSearch->nome) {
            $query->andWhere(['like', 'nome', $produtoSearch->nome]);
        }

        $produtos = $query->all();

        $totalCount = $query->count();

        $pagination = new Pagination([
            'totalCount' => $totalCount,
            'pageSize' => 10,
        ]);

        $produtos = $query->offset($pagination->offset)
                        ->limit($pagination->limit)
                        ->all();

                    $categorias = Categoria::find()->all();
        
        return $this->render('index', [
            'categorias' => $categorias,
            'produtoSearch' => $produtoSearch,
            'produtos' => $produtos,
            'pagination' => $pagination
        ]);

    }

    public function actionShow($id)
    {

        $produto = Produto::find()
            ->where(['id' => $id])
            ->with(['marca', 'imagens', 'categoria', 'valornutricional'])
            ->one();

        if (!$produto) {
            throw new NotFoundHttpException('The requested produto does not exist.');
        }

        return $this->render('show', [
            'produto' => $produto,

        ]);
    }

    public function actionAddToCart()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $produtoId = $request->post('produto_id');
            $quantidade = $request->post('quantidade', 1); // Default to 1 if not provided

            $user = Yii::$app->user->identity;
            $userProfile = UserProfile::findOne(['user_id' => $user->id]);
            $carrinho = Carrinho::findOne($userProfile->carrinho_id);

            if (!$carrinho) {
                Yii::$app->session->setFlash('error', 'Cart not found.');
                return $this->redirect(['produto/index']);
            }

            // Fetch product details
            $produto = Produto::findOne($produtoId);
            if (!$produto) {
                Yii::$app->session->setFlash('error', 'Product not found.');
                return $this->redirect(['produto/index']);
            }

            if($produto->quantidade < $quantidade)
            {
                Yii::$app->session->setFlash('error', 'Quantidade desejada excede o stock existente');
                return $this->redirect(['produto/show',
                    'id' => $produto->id
                ]);
            }

            // Check if the product is already in the cart
            $linha = LinhaCarrinho::find()
                ->where(['carrinho_id' => $carrinho->id, 'produto_id' => $produtoId])
                ->one();

            if ($linha) {
                // Update quantity if already in cart
                $linha->quantidade += $quantidade;
                $linha->total = $linha->precoUnitario * $linha->quantidade;
            } else {
                // Add new line item
                $linha = new LinhaCarrinho([
                    'carrinho_id' => $carrinho->id,
                    'produto_id' => $produtoId,
                    'quantidade' => $quantidade,
                    'precoUnitario' => $produto->preco,
                    'total' => $produto->preco * $quantidade,
                ]);
            }

            // Save line item
            if ($linha->save()) {
                Yii::$app->session->setFlash('success', 'Produto adicionado com sucesso.');
            } else {
                Yii::$app->session->setFlash('error', 'Falha a adicionar produto.');
            }
        }

        return $this->redirect(['carrinho/index']);
    }


}
