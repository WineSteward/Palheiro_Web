<?php

namespace frontend\controllers;

use common\models\Carrinho;
use common\models\Fatura;
use common\models\Linhafatura;
use common\models\Userprofile;
use Yii;

class LinhafaturaController extends \yii\web\Controller
{
    public function createLinhasFatura($faturaId)
    {
        $user = Yii::$app->user->identity;
        $userProfile = UserProfile::findOne(['user_id' => $user->id]);
        $carrinho = Carrinho::findOne($userProfile->carrinho_id);

        if (!$carrinho || empty($carrinho->linhaCarrinhos)) {
            Yii::$app->session->setFlash('error', 'Carrinho vazio.');
            return false;
        }

        foreach ($carrinho->linhaCarrinhos as $linhaCarrinho) {
            $produto = $linhaCarrinho->produto;

            $linhaFatura = new LinhaFatura();
            $linhaFatura->fatura_id = $faturaId;
            $linhaFatura->produto_id = $produto->id;
            $linhaFatura->quantidade = $linhaCarrinho->quantidade;
            $linhaFatura->valorUnitario = $produto->preco;
            $linhaFatura->total = $linhaFatura->quantidade * $linhaFatura->valorUnitario;

            // Calculate VAT
            $linhaFatura->porcentagemIva = $produto->iva;
            $linhaFatura->valorIva = $linhaFatura->total * $linhaFatura->porcentagemIva / 100;
            $linhaFatura->subtotal = $linhaFatura->total + $linhaFatura->valorIva;

            if (!$linhaFatura->save()) {
                Yii::$app->session->setFlash('error', 'Erro ao salvar item da fatura.');
                return false;
            }
        }

        // Clear cart after creating invoice lines
        foreach ($carrinho->linhaCarrinhos as $linhaCarrinho) {
            $linhaCarrinho->delete();
        }

        return true;
    }

    public function updateTotalFatura($faturaId)
    {
        $fatura = Fatura::findOne($faturaId);

        if (!$fatura) {
            throw new \yii\web\NotFoundHttpException('Fatura não encontrada.');
        }

        $linhaFaturas = LinhaFatura::find()->where(['fatura_id' => $faturaId])->all();

        $total = 0;
        foreach ($linhaFaturas as $linha) {
            $total += $linha->subtotal;
        }

        // Apply discount if applicable
        if ($fatura->desconto) {
            $total -= $total * $fatura->desconto->valor / 100;
        }

        $fatura->total = $total;

        if (!$fatura->save()) {
            Yii::$app->session->setFlash('error', 'Erro ao atualizar total da fatura.');
            return false;
        }

        return true;
    }


}
