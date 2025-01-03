<?php

namespace frontend\controllers;

use common\models\Carrinho;
use common\models\Desconto;
use common\models\Userprofile;
use common\models\Linhacarrinho;
use common\models\Metodoexpedicao;
use common\models\Metodopagamento;
use common\models\Userdesconto;
use Yii;
use yii\helpers\Url;

class CarrinhoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']); // Redirect if not logged in
        }

        $user = Yii::$app->user->identity;
        // Retrieve the user profile associated with the current user
        // $userProfile = $user->userprofile;
        $userProfile = UserProfile::findOne(['user_id' => $user->id]);

        if (!$userProfile || !$userProfile->carrinho_id) {
            Yii::$app->session->setFlash('error', 'Carrinho not found.');
            return $this->redirect(['produto/index']); // Redirect to a safe page
        }

        // Fetch the Carrinho using carrinho_id from the user profile
        $carrinho = Carrinho::findOne($userProfile->carrinho_id);

        if (!$carrinho) {
            Yii::$app->session->setFlash('error', 'Carrinho not found.');
            return $this->redirect(['produto/index']); // Redirect to a safe page
        }
        $carrinho->updateTotal();
        // Retrieve all LinhasCarrinho associated with this Carrinho
        $linhasCarrinho = LinhaCarrinho::find()->where(['carrinho_id' => $carrinho->id])->all();

        return $this->render('index', [
            'carrinho' => $carrinho,
            'linhascarrinhos' => $linhasCarrinho,
        ]);
    }

    public function actionMetodos()
    {
        $user = Yii::$app->user->identity;
        $userProfile = UserProfile::findOne(['user_id' => $user->id]);
        $carrinho = Carrinho::findOne($userProfile->carrinho_id);

        $metodospagamento = Metodopagamento::find()->where(['vigor' => 1])->all();
        $metodosexpedicao = Metodoexpedicao::find()->where(['vigor' => 1])->all();

        if (!$carrinho || empty($carrinho->linhascarrinhos)) {
            // redirect para o carrinho se nao tiver items no carrinho
            Yii::$app->session->setFlash('error', 'O seu carrinho está vazio. Adicione itens antes de continuar.');
            return $this->redirect(['carrinho/index']);
        }

        $request = Yii::$app->request;
        if ($request->isPost) {

            $metodoPagamentoId = $request->post('metodoPagamentoId');
            $metodoExpedicaoId = $request->post('metodoExpedicaoId');

            if (!$metodoPagamentoId || !$metodoExpedicaoId) {
                Yii::$app->session->setFlash('error', 'Por favor, escolha um método de pagamento e um método de expedição.');
                return $this->render('metodos', [
                    'metodospagamento' => $metodospagamento,
                    'metodosexpedicao' => $metodosexpedicao,
                ]);
            }

            return $this->redirect(['checkout',
                'metodoPagamentoId' => $metodoPagamentoId,
                'metodoExpedicaoId' => $metodoExpedicaoId]);
        }

        $metodospagamento = Metodopagamento::find()->where(['vigor' => 1])->all();
        $metodosexpedicao = Metodoexpedicao::find()->where(['vigor' => 1])->all();

        return $this->render('metodos', [
            'metodospagamento' => $metodospagamento,
            'metodosexpedicao' => $metodosexpedicao,
        ]);
    }

    public function actionCheckout($metodoExpedicaoId, $metodoPagamentoId)
    {
        $user = Yii::$app->user->identity;
        $userProfile = UserProfile::findOne(['user_id' => $user->id]);
        $carrinho = Carrinho::find()
                    ->with(['linhascarrinhos', 'linhascarrinhos.produto', 'linhascarrinhos.produto.iva'])
                    ->where(['id' => $userProfile->carrinho_id])
                    ->one();

        $metodoExpedicao = Metodoexpedicao::findOne($metodoExpedicaoId);
        $metodoPagamento = Metodopagamento::findOne($metodoPagamentoId);

        Yii::$app->session->set('metodoExpedicao', $metodoExpedicao);
        Yii::$app->session->set('metodoPagamento', $metodoPagamento);

        $placeholderTotal = Yii::$app->request->get('placeholderTotal', null);

        return $this->render('checkout', [
            'carrinho' => $carrinho,
            'metodoPagamento' => $metodoPagamento,
            'metodoExpedicao' => $metodoExpedicao,
            'placeholderTotal' => $placeholderTotal
        ]);
    }

    public function actionDesconto()
    {
        $metodoExpedicao = Yii::$app->session->get('metodoExpedicao');
        $metodoPagamento = Yii::$app->session->get('metodoPagamento');

        $request = Yii::$app->request;
        $codigo = $request->post('discountCode');

        $user = Yii::$app->user->identity;
        $userProfile = $user->userprofile;
        $carrinho = Carrinho::findOne($userProfile->carrinho_id);

        // Verifica se o codigo é valido
        $desconto = Desconto::findOne(['nome' => $codigo]);

        if (!$desconto) {
            Yii::$app->session->setFlash('error', 'Código de desconto inválido.');

            return $this->redirect(['checkout',
            'metodoPagamentoId' => $metodoPagamento->id,
            'metodoExpedicaoId' => $metodoExpedicao->id,
        ]);
        }

        // Verifica se o utilizador tem o codigo e esta valido
        $userDesconto = Userdesconto::findOne([
            'userprofile_id' => $userProfile->id,
            'desconto_id' => $desconto->id,
            'valido' => 1,
        ]);

        if (!$userDesconto) {
                Yii::$app->session->setFlash('error', 'Código de desconto inválido.');

                return $this->redirect(['checkout',
                'metodoPagamentoId' => $metodoPagamento->id,
                'metodoExpedicaoId' => $metodoExpedicao->id,
            ]);
        }

        // aplicar desconto provisoriamente
        $placeholderTotal = $carrinho->total - ($carrinho->total * ($userDesconto->desconto->valor/100));

        Yii::$app->session->setFlash('success', 'Desconto aplicado com sucesso!');

        Yii::$app->session->set('desconto', $codigo);

        return $this->redirect(['checkout',
            'metodoPagamentoId' => $metodoPagamento->id,
            'metodoExpedicaoId' => $metodoExpedicao->id,
            'placeholderTotal' => $placeholderTotal
        ]);
        
    }
}
