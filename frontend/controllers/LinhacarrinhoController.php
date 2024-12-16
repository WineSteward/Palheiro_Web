<?php

namespace frontend\controllers;

use common\models\Carrinho;
use common\models\Iva;
use common\models\Linhacarrinho;
use common\models\Produto;
use common\models\Userprofile;

class LinhacarrinhoController extends \yii\web\Controller
{

    public function actionUpdateQuantity($linha_id, $quantidade)
    {
        $linhaCarrinho = LinhaCarrinho::findOne($linha_id);

        if ($linhaCarrinho && $quantidade > 0) {
            $linhaCarrinho->quantidade = $quantidade;
            $linhaCarrinho->save();

            // Update the cart total
            $carrinho = $linhaCarrinho->carrinho;
            $this->updateCartTotal($carrinho);
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
                // Update the cart total after deleting the item
                $this->updateCartTotal($carrinho);
            }
        }

        return $this->redirect(['carrinho/index']);
    }

    private function updateCartTotal(Carrinho $carrinho)
    {
        $total = 0;

        // Iterate over related LinhaCarrinho records
        foreach ($carrinho->linhascarrinhos as $linha) {
            $produto = $linha->produto;
            $total += $produto->preco * $linha->quantidade;
        }

        $carrinho->total = $total;
        $carrinho->save();
    }




}
