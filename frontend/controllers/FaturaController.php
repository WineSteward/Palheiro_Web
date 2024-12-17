<?php

namespace frontend\controllers;

use common\models\Carrinho;
use common\models\Fatura;
use common\models\Linhafatura;
use common\models\Metodoexpedicao;
use common\models\Metodopagamento;
use common\models\Userprofile;
use Yii;

class FaturaController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $fatura = Fatura::findOne($id);

        if (!$fatura) {
            throw new \yii\web\NotFoundHttpException('Fatura not found.');
        }

        return $this->render('index' ,['fatura' => $fatura]);
    }

    public function actionMetodos()
    {
        $user = Yii::$app->user->identity;
        $userProfile = UserProfile::findOne(['user_id' => $user->id]);
        $carrinho = Carrinho::findOne($userProfile->carrinho_id);

        if (!$carrinho || empty($carrinho->linhascarrinhos)) {
            // redirect para o carrinho se nao tiver items no carrinho
            Yii::$app->session->setFlash('error', 'O seu carrinho está vazio. Adicione itens antes de continuar.');
            return $this->redirect(['carrinho/index']);
        }

        $request = Yii::$app->request;
        if ($request->isPost) {

            //todo verificar se é entrege na morada ou na loja e dps mostrar os metodso
            $metodoPagamentoId = $request->post('metodoPagamentoId');
            $metodoExpedicaoId = $request->post('metodoExpedicaoId');

            if (!$metodoPagamentoId || !$metodoExpedicaoId) {
                Yii::$app->session->setFlash('error', 'Por favor, escolha um método de pagamento e um método de expedição.');
                $metodospagamento = Metodopagamento::find()->where(['vigor' => 1])->all();
                $metodosexpedicao = Metodoexpedicao::find()->where(['vigor' => 1])->all();
                return $this->render('metodopagamento', [
                    'metodospagamento' => $metodospagamento,
                    'metodosexpedicao' => $metodosexpedicao,
                ]);
            }

            return $this->redirect(['fatura/create',
                'metodoPagamentoId' => $metodoPagamentoId,
                'metodoExpedicaoId' => $metodoExpedicaoId]);
        }

        $metodospagamento = Metodopagamento::find()->where(['vigor' => 1])->all();
        $metodosexpedicao = Metodoexpedicao::find()->where(['vigor' => 1])->all();
        return $this->render('metodopagamento', [
            'metodospagamento' => $metodospagamento,
            'metodosexpedicao' => $metodosexpedicao,
        ]);
    }

    public function actionCreate($metodoExpedicaoId, $metodoPagamentoId)
    {
        $metodoExpedicao = Metodoexpedicao::findOne($metodoExpedicaoId);
        $metodoPagamento = Metodopagamento::findOne($metodoPagamentoId);

        if (!$metodoExpedicao || !$metodoPagamento) {
            Yii::$app->session->setFlash('error', 'Forma de pagamento ou expedição inválida.');
            return $this->redirect(['carrinho/index']);
        }

        $fatura = new Fatura();
        $user = Yii::$app->user->identity;
        $userProfile = UserProfile::findOne(['user_id' => $user->id]);
        $fatura->userprofile_id = $userProfile->id;
        $fatura->metodoexpedicao_id = $metodoExpedicao->id;
        $fatura->metodopagamento_id = $metodoPagamento->id;
        $fatura->dataVenda = date('d-m-Y H:i:s', time() );
        $fatura->estadoEncomenda = 0;//0=pendente
        $fatura->total=0;// por fazer
        $fatura->valida=0;//por finalizar

        if ($fatura->save()) {
            $carrinho= Carrinho::findOne(['id'=>$userProfile->carrinho_id]);
            foreach ($carrinho->linhascarrinhos as $linhaCarrinho)
            {
                $linhaFatura = new LinhaFatura();
                $linhaFatura->fatura_id = $fatura->id;
                $linhaFatura->produto_id = $linhaCarrinho->produto_id;
                $linhaFatura->quantidade = $linhaCarrinho->quantidade;
                $linhaFatura->valorUnitario = $linhaCarrinho->produto->preco;
                $linhaFatura->total = $linhaCarrinho->quantidade * $linhaFatura->valorUnitario;

                // Calcula Ivas
                $linhaFatura->porcentagemIva = $linhaCarrinho->produto->iva->valorPorcentagem;//mudar iva  para float na bd
                $linhaFatura->valorIva = $linhaFatura->total * ($linhaFatura->porcentagemIva /100);
                $linhaFatura->subtotal = $linhaFatura->total - $linhaFatura->valorIva;

                if (!$linhaFatura->save()) {
                    Yii::$app->session->setFlash('error', 'Erro ao salvar item da fatura.');
                    return false;
                }
            }
            // Clear cart after creating invoice lines
            foreach ($carrinho->linhascarrinhos as $linhaCarrinho) {
                $linhaCarrinho->delete();
            }

            return $this->redirect(['fatura/index', 'id' => $fatura->id]);
        }

        Yii::$app->session->setFlash('error', 'Falha ao criar fatura.');
        return $this->redirect(['carrinho/index']);
    }


}
