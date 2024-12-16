<?php

namespace frontend\controllers;

use common\models\Carrinho;
use common\models\Fatura;
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

        if (Yii::$app->request->isPost) {

            $metodoPagamentoId = Yii::$app->request->post('metodoPagamentoId');
            $metodoExpedicaoId = Yii::$app->request->post('metodoExpedicaoId');

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
        var_dump(Yii::$app->request->post());
        die;
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
        $fatura->userprofile_id = Yii::$app->user->id;
        $fatura->metodoexpedicao_id = $metodoExpedicao->id;
        $fatura->metodopagamento_id = $metodoPagamento->id;
        $fatura->dataVenda = date('Y-m-d H:i:s');
        $fatura->estadoEncomenda = 0;//0=pendente

        if ($fatura->save()) {
            if ($this->createInvoiceLines($fatura->id)) {
                $this->updateInvoiceTotal($fatura->id);
                return $this->redirect(['fatura/index', 'id' => $fatura->id]);
            }
        }

        Yii::$app->session->setFlash('error', 'Falha ao criar fatura.');
        return $this->redirect(['carrinho/index']);
    }


}
