<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use common\models\Produto;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

class CarrinhoController extends ActiveController
{
    public function behaviors()
    {
        Yii::$app->params['id'] = 0;
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CustomAuth::className(),
        ];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if (Yii::$app->params['id'] == 0) {
            throw new \yii\web\ForbiddenHttpException('Proibido');
        }
    }

    public $profileClass = 'common\models\Userprofile';
    public $userClass = 'common\models\User';
    public $modelClass = 'common\models\Carrinho';
    public $linhaModel = 'common\models\Linhacarrinho';
    public $produtoModel = 'common\models\Produto';


    public function actionMy()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $user = $this->userClass::findOne(Yii::$app->params['id']);
        
        $profile = $this->profileClass::find()->where(['user_id' => $user->id])->one();
        
        $carrinho = $this->modelClass::findOne($profile->carrinho_id);
        if (!$carrinho) {
            return ['error' => 'Carrinho nao encontrado'];
        }

        $linhasCarrinho = $this->linhaModel::find()->where(['carrinho_id' => $carrinho->id])->all();

        $carrinhoData = $carrinho->toArray();
        $carrinhoData['linhascarrinho'] = [];

        foreach ($linhasCarrinho as $linha) {
            
            $linhaData = $linha->toArray();

            // get the associated produto
            $produto = Produto::findOne($linha->produto_id);
            if ($produto) {
                // only inserted the attributes of the product I want to return
                $linhaData['produto'] = [
                    'id' => $produto->id,
                    'nome' => $produto->nome,
                    'preco' => $produto->preco,
                    'quantidade' => $produto->quantidade,
                    'imagens' => $produto->imagens,
                    'marca' => $produto->marca
                ];

            } else {
                $linhaData['produto'] = null;
            }

            // remove unwanted attributes from linhascarrinho
            unset($linhaData['carrinho_id'], $linhaData['produto_id']);

            $carrinhoData['linhascarrinho'][] = $linhaData;
        }

        return $carrinhoData;
    }


    /**
     * @param $id do produto que queremos adicionar ao carrinho de compras 
     */
    public function actionAdd($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $user = $this->userClass::findOne(Yii::$app->params['id']);
        
        $profile = $this->profileClass::find()->where(['user_id' => $user->id])->one();
        if (!$profile) {
            return ['error' => 'Profile nao encontrado'];
        }

        $carrinho = $this->modelClass::findOne($profile->carrinho_id);
        if (!$carrinho) {
            return ['error' => 'Carrinho nao encontrado'];
        }

        $produto = $this->produtoModel::findOne($id);
        if (!$produto) {
            return ['error' => 'Produto nao encontrado'];
        }

        foreach($carrinho->linhascarrinhos as $linhaCarrinho)
        {
            if($linhaCarrinho->produto_id == $id)
               {
                    $linhaCarrinho->quantidade += 1;
                    $linhaCarrinho->total = $linhaCarrinho->precoUnitario * $linhaCarrinho->quantidade;
                    $linhaCarrinho->save();

                    $carrinho->total += $linhaCarrinho->precoUnitario;
                    $carrinho->save();
                    return;
               }     
        }

        $linhaCarrinho = new $this->linhaModel;

        $linhaCarrinho->carrinho_id = $carrinho->id;
        $linhaCarrinho->produto_id = $produto->id;
        $linhaCarrinho->precoUnitario = $produto->preco;
        $linhaCarrinho->quantidade = 1;
        $linhaCarrinho->total =  $linhaCarrinho->precoUnitario;

        $linhaCarrinho->save();

        $carrinho->total += ($linhaCarrinho->quantidade * $linhaCarrinho->precoUnitario);

        $carrinho->save();
    }

    /**
     * @param $id da linha do carrinho que queremos alterar a quantidade
     */
    public function actionEdit($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $user = $this->userClass::findOne(Yii::$app->params['id']);
        
        $profile = $this->profileClass::find()->where(['user_id' => $user->id])->one();
        
        $carrinho = $this->modelClass::findOne($profile->carrinho_id);
        if (!$carrinho) {
            return ['error' => 'Carrinho nao encontrado'];
        }

        $linhaCarrinho = $this->linhaModel::findOne($id);

        if (Yii::$app->request->getBodyParam('quantidade') == 0)
        {
            $carrinho->total = $carrinho->total - $linhaCarrinho->total;
            $carrinho->save();
            $linhaCarrinho->delete();
            return ['total' => $carrinho->total];
        }

        $carrinho->total -= ($linhaCarrinho->quantidade * $linhaCarrinho->precoUnitario);

        $linhaCarrinho->quantidade = Yii::$app->request->getBodyParam('quantidade');
        $linhaCarrinho->total = $linhaCarrinho->quantidade * $linhaCarrinho->precoUnitario;
        $linhaCarrinho->save();

        $carrinho->total += ($linhaCarrinho->quantidade * $linhaCarrinho->precoUnitario);
        $carrinho->save();

        return ['total' => $carrinho->total];
    }

    /**
     * @param $id da linha do carrinho desejada a eliminar
     */
    public function actionLinhadelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $user = $this->userClass::findOne(Yii::$app->params['id']);
        
        $profile = $this->profileClass::find()->where(['user_id' => $user->id])->one();
        
        $carrinho = $this->modelClass::findOne($profile->carrinho_id);
        if (!$carrinho) {
            return ['error' => 'Carrinho nao encontrado'];
        }

        $linhaCarrinho = $this->linhaModel::findOne($id);

        $carrinho->total -= ($linhaCarrinho->total);
        $carrinho->save();

        $linhaCarrinho->delete();
    }
}
