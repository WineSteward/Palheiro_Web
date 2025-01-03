<?php

namespace frontend\controllers;

use common\models\Carrinho;
use common\models\Desconto;
use common\models\Fatura;
use common\models\Linhafatura;
use common\models\Produto;
use common\models\Userdesconto;
use common\models\Userprofile;
use Exception;
use Yii;


class FaturaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;

        $faturas = $user->userprofile->faturas;

        // Sort faturas by dataVenda most recent first
        usort($faturas, function ($a, $b) {
            return strtotime($b->dataVenda) - strtotime($a->dataVenda);
        });

        return $this->render('index', ['faturas' => $faturas]);
    }


    public function actionView($id)
    {
        $fatura = Fatura::find()
            ->with(['linhasfatura', 'metodoexpedicao', 'metodopagamento'])
            ->where(['id' => $id])
            ->one();

        if (!$fatura) {
            throw new \yii\web\NotFoundHttpException('Fatura not found.');
        }

        return $this->render('view', ['fatura' => $fatura]);
    }

    public function actionCreate()
    {
        try {
            $metodoExpedicao = Yii::$app->session->get('metodoExpedicao');
            $metodoPagamento = Yii::$app->session->get('metodoPagamento');

            if (!$metodoExpedicao || !$metodoPagamento) {
                Yii::$app->session->setFlash('error', 'Método de pagamento/expedição inválida.');
                return $this->redirect([
                    'carrinho/checkout',
                    'metodoPagamentoId' => $metodoPagamento->id,
                    'metodoExpedicaoId' => $metodoExpedicao->id,
                ]);
            }

            $user = Yii::$app->user->identity;
            $userProfile = UserProfile::findOne(['user_id' => $user->id]);

            $carrinho = Carrinho::find()
                ->with(['linhascarrinhos', 'linhascarrinhos.produto'])
                ->where(['id' => $user->userprofile->carrinho_id])
                ->one();

            foreach ($carrinho->linhascarrinhos as $linha) {
                $produtoAtual = Produto::findOne($linha->produto->id);
                if ($linha->quantidade > $produtoAtual->quantidade) {
                    Yii::$app->session->setFlash('error', 'Quantidade excedida do stock ' . $produtoAtual->nome);
                    return $this->redirect([
                        'carrinho/checkout',
                        'metodoPagamentoId' => $metodoPagamento->id,
                        'metodoExpedicaoId' => $metodoExpedicao->id,
                    ]);
                }
            }


            $fatura = new Fatura();
            $fatura->dataVenda = date('Y-m-d H:i:s');
            $fatura->valida = 0;
            $fatura->estadoEncomenda = 0;
            $fatura->userprofile_id = $userProfile->id;
            $fatura->metodoexpedicao_id = $metodoExpedicao->id;
            $fatura->metodopagamento_id = $metodoPagamento->id;
            $fatura->total = 0;
            $fatura->save();

            $cupao = Yii::$app->session->get('desconto') ?? "";

            //cupao deixa de ser valido para o utilizador
            //criar uma linha da fatura para o desconto aplicado
            //converter todas as linhas do carrinho em linhas fatura
            //limpar todas as linhas do carrinho
            //guardar a fatura
            //limpar o total do carrinho
            //guardar o carrinho

            if ($cupao != "") {

                $descontos = Userdesconto::find(['userprofile_id' => $user->userprofile->id])->all();

                if (!Desconto::validateCupao($cupao, $user->userprofile->id)) {

                    Yii::$app->session->setFlash('error', 'Cupão Inválido');
                    
                    unset($cupao);
                    Yii::$app->session->remove('desconto');
                    
                    return $this->redirect([
                        'carrinho/checkout',
                        'metodoPagamentoId' => $metodoPagamento->id,
                        'metodoExpedicaoId' => $metodoExpedicao->id,
                    ]);
                }
                foreach ($descontos as $desconto) {
                    if ($desconto->valido) {
                        $descontoAtual = Desconto::findOne($desconto->desconto_id);

                        if ($descontoAtual->nome == $cupao) {

                            $valorDesconto = ($carrinho->total * (1 / $descontoAtual->valor));
                            $carrinho->total = $carrinho->total - $valorDesconto;
                            $desconto->valido = 0;

                            $fatura->desconto_id = $descontoAtual->id;

                            $linhaFaturaDesconto = new Linhafatura();
                            $linhaFaturaDesconto->valorUnitario = $valorDesconto;
                            $linhaFaturaDesconto->quantidade = 1;
                            $linhaFaturaDesconto->total = $valorDesconto;
                            $linhaFaturaDesconto->porcentagemIva = 0;
                            $linhaFaturaDesconto->valorIva = 0;
                            $linhaFaturaDesconto->subtotal = $valorDesconto;
                            $linhaFaturaDesconto->fatura_id = $fatura->id;
                            $linhaFaturaDesconto->save();
                            $desconto->save();
                            break;
                        }
                    }
                }
            }

            foreach ($carrinho->linhascarrinhos as $linhaCarrinho) 
            {
                $linhaFatura = new Linhafatura();
                $linhaFatura->valorUnitario = $linhaCarrinho->precoUnitario;
                $linhaFatura->quantidade = $linhaCarrinho->quantidade;
                $linhaFatura->total = round($linhaCarrinho->precoUnitario * $linhaCarrinho->quantidade, 2);
                $linhaFatura->porcentagemIva = $linhaCarrinho->produto->iva->valorPorcentagem;
                $linhaFatura->valorIva = round((1 / $linhaFatura->porcentagemIva) * $linhaFatura->valorUnitario, 2);
                $linhaFatura->subtotal = round($linhaFatura->total - $linhaFatura->valorIva, 2);
                $linhaFatura->fatura_id = $fatura->id;
                $linhaFatura->produto_id = $linhaCarrinho->produto_id;

                $produtoAtual = Produto::findOne($linhaCarrinho->produto_id);
                $produtoAtual->quantidade -= $linhaCarrinho->quantidade;
                $produtoAtual->save();

                $linhaFatura->save();
                $linhaCarrinho->delete();
            }

            $fatura->total = round($carrinho->total, 2);
            $fatura->valida = 1;
            $fatura->save();

            $carrinho->total = 0;
            $carrinho->save();

            Yii::$app->session->remove('desconto');
            Yii::$app->session->remove('metodoPagamento');
            Yii::$app->session->remove('metodoExpedicao');

            Yii::$app->session->setFlash('success', 'Compra concluída com sucesso!');
            return $this->redirect(['site/index']);
        } catch (Exception) {
            Yii::$app->session->remove('desconto');

            Yii::$app->session->setFlash('error', 'Falha ao criar fatura.');
            return $this->redirect([
                'carrinho/checkout',
                'metodoPagamentoId' => $metodoPagamento->id,
                'metodoExpedicaoId' => $metodoExpedicao->id,
            ]);
        }
    }
}
