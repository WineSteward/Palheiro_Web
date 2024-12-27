<?php

namespace frontend\controllers;

use common\models\Carrinho;
use common\models\LinhaCarrinho;
use Yii;
use yii\web\Controller;

class LinhacarrinhoController extends Controller
{
    public function actionUpdateQuantity()
    {
        $linha_id = Yii::$app->request->post('linha_id');
        $quantidade = Yii::$app->request->post('quantidade');

        $linhaCarrinho = LinhaCarrinho::findOne($linha_id);

        if ($linhaCarrinho && $quantidade > 0) {
            $linhaCarrinho->quantidade = $quantidade;
            $linhaCarrinho->total = $linhaCarrinho->produto->preco * $quantidade;
            $linhaCarrinho->save(false);

            $carrinho = $linhaCarrinho->carrinho;
            $carrinho->updateTotal();
            Yii::$app->session->setFlash('success', 'Carrinho atualizado com sucesso.');
        }

        return $this->redirect(['carrinho/index']);
    }


    public function actionDelete($id)
    {
        $linhaCarrinho = LinhaCarrinho::findOne($id);

        if ($linhaCarrinho) {
            $carrinho = $linhaCarrinho->carrinho;
            $linhaCarrinho->delete();

            if ($carrinho) {
                $carrinho->updateTotal();
            }
        }

        return $this->redirect(['carrinho/index']);
    }
}
