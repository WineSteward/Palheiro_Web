<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use common\models\Desconto;
use common\models\Linhafatura;
use common\models\Metodoexpedicao;
use common\models\Metodopagamento;
use common\models\Produto;
use common\models\Userdesconto;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

class FaturaController extends ActiveController
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

    public $modelClass = 'common\models\Fatura';
    public $userClass = 'common\models\User';
    public $profileClass = 'common\models\Userprofile';
    public $carrinhoClass = 'common\models\Carrinho';
    public $descontoClass = 'common\models\Desconto';

    public function actionAll()
    {
        $model = new $this->modelClass;

        Yii::$app->response->format = Response::FORMAT_JSON;

        $user = $this->userClass::findOne(Yii::$app->params['id']);
        $profile = $this->profileClass::find()->where(['user_id' => $user->id])->one();

        $faturas = $model::find()
            ->where(['userprofile_id' => $profile->id])
            ->andWhere(['valida' => '1'])
            ->orderBy(['dataVenda' => SORT_DESC])
            ->all();

        $faturasWithDetails = [];

        foreach ($faturas as $fatura) {
            $linhasfatura = LinhaFatura::find()->where(['fatura_id' => $fatura->id])->asArray()->all();

/*             foreach ($linhasfatura as &$linha) {
                $produto = Produto::findOne($linha['produto_id']);
                $linha['produto'] = $produto ? $produto->toArray() : null;
                unset($linha['produto_id']); // Optionally remove produto_id
            }
 */
            $metodoexpedicao = MetodoExpedicao::findOne($fatura->metodoexpedicao_id);

            $metodopagamento = MetodoPagamento::findOne($fatura->metodopagamento_id);

            
            $faturaData = $fatura->toArray();
            unset($faturaData['metodoexpedicao_id']);
            unset($faturaData['metodopagamento_id']);
            unset($faturaData['valida']);
            unset($faturaData['estadoEncomenda']);
            unset($faturaData['userprofile_id']);

            $faturaData['linhasfatura'] = $linhasfatura;
            $faturaData['metodoexpedicao'] = $metodoexpedicao;
            $faturaData['metodopagamento'] = $metodopagamento;

            $faturasWithDetails[] = $faturaData;
        }


        return $faturasWithDetails;
    }

    public function actionOne($id)
    {
        $model = new $this->modelClass;

        Yii::$app->response->format = Response::FORMAT_JSON;

        $encomenda = $model::findOne($id);

        $linhasfatura = Linhafatura::find()->where(['fatura_id' => $encomenda->id])->all();

        $metodoexpedicao = Metodoexpedicao::findOne($encomenda->metodoexpedicao_id);

        $metodopagamento = Metodopagamento::findOne($encomenda->metodopagamento_id);

        $encomendaData = $encomenda->toArray();
        $encomendaData['linhasfatura'] = $linhasfatura;
        $encomendaData['metodoexpedicao'] = $metodoexpedicao;
        $encomendaData['metodopagamento'] = $metodopagamento;

        return $encomendaData;
    }

    public function actionCriar()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = \Yii::$app->request;

        $metodoexpedicao_id = $request->post('metodoexpedicao_id');
        $metodopagamento_id = $request->post('metodopagamento_id');
        $cupao = $request->post('cupao');

        $user = $this->userClass::find()->where(['id' => Yii::$app->params['id']])->one();

        $carrinho = $this->carrinhoClass::find()
                                            ->with(['linhascarrinhos', 'linhascarrinhos.produto'])
                                            ->where(['id'=>$user->userprofile->carrinho_id])
                                            ->one();

        foreach($carrinho->linhascarrinhos as $linha)
        {
            $produtoAtual = Produto::findOne($linha->produto->id);
            if($linha->quantidade > $produtoAtual->quantidade)
                return ['response' => 'quantidade excedente do stock ' . $produtoAtual->nome];
        }


        $fatura = new $this->modelClass;
        $fatura->dataVenda = date('Y-m-d H:i:s');
        $fatura->valida = 0;
        $fatura->estadoEncomenda = 0;
        $fatura->userprofile_id = $user->userprofile->id;
        $fatura->metodoexpedicao_id = $metodoexpedicao_id;
        $fatura->metodopagamento_id = $metodopagamento_id;
        $fatura->total = 0;
        $fatura->save();


        //cupao deixa de ser valido para o utilizador
        //criar uma linha da fatura para o desconto aplicado
        //converter todas as linhas do carrinho em linhas fatura
        //limpar todas as linhas do carrinho
        //guardar a fatura
        //limpar o total do carrinho
        //guardar o carrinho

        if ($cupao != "")
        {
            $descontos = Userdesconto::find(['userprofile_id' => $user->userprofile->id])->all();
            
            if(!Desconto::validateCupao($cupao, $user->userprofile->id))
                return ['response' => 'Invalid'];

            foreach ($descontos as $desconto) {
                if ($desconto->valido) 
                {
                    $descontoAtual = Desconto::findOne($desconto->desconto_id);

                    if ($descontoAtual->nome == $cupao)
                    {
                        
                        $valorDesconto = ($carrinho->total * (1 / $descontoAtual->valor));
                        $carrinho->total = $carrinho->total - $valorDesconto;
                        
                        $desconto->valido = 0;
                        $desconto->save();

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
                        break;
                    }
                }
            }
        }

        foreach($carrinho->linhascarrinhos as $linhaCarrinho)
        {
            $linhaFatura = new Linhafatura();
            $linhaFatura->valorUnitario = $linhaCarrinho->precoUnitario;
            $linhaFatura->quantidade = $linhaCarrinho->quantidade;
            $linhaFatura->total = round($linhaCarrinho->precoUnitario * $linhaCarrinho->quantidade, 2);
            $linhaFatura->porcentagemIva = $linhaCarrinho->produto->iva->valorPorcentagem;
            $linhaFatura->valorIva = round((1/$linhaFatura->porcentagemIva) * $linhaFatura->valorUnitario, 2);
            $linhaFatura->subtotal = round($linhaFatura->total - $linhaFatura->valorIva, 2);
            $linhaFatura->fatura_id = $fatura->id;
            $linhaFatura->produto_id = $linhaCarrinho->produto_id;

            $linhaFatura->save();
            $linhaCarrinho->delete();
        }

        $fatura->total = round($carrinho->total, 2);
        $fatura->valida = 1;
        $fatura->save();

        $carrinho->total = 0;
        $carrinho->save();

        return ['response' => 'success'];
    }
}
