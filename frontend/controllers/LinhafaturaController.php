<?php

namespace frontend\controllers;

use common\models\Carrinho;
use common\models\Fatura;
use common\models\Linhafatura;
use common\models\Userprofile;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class LinhafaturaController extends \yii\web\Controller
{
        /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'metodos', 'checkout', 'desconto'],
                        'allow' => true,
                        'roles' => ['client', '?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'desconto' => ['POST'],
                ],
            ],
        ];
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
