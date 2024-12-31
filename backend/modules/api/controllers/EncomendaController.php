<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use common\models\Linhafatura;
use common\models\Metodoexpedicao;
use common\models\Metodopagamento;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

class EncomendaController extends ActiveController
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

    public function actionAll()
    {
        $model = new $this->modelClass;

        $request = \Yii::$app->request;

        Yii::$app->response->format = Response::FORMAT_JSON;

        $user = $this->userClass::findOne(Yii::$app->params['id']);
        $profile = $this->profileClass::find()->where(['user_id' => $user->id])->one();

        $encomendas = $model::find()
            ->where(['userprofile_id' => $profile->id])
            ->andWhere(['estadoEncomenda' => '0'])
            ->andWhere(['valida' => '1'])
            ->orderBy(['dataVenda' => SORT_DESC])
            ->all();

        $encomendasWithDetails = [];

        foreach ($encomendas as $encomenda)
        {
            $metodoexpedicao = MetodoExpedicao::findOne($encomenda->metodoexpedicao_id);

            $metodopagamento = MetodoPagamento::findOne($encomenda->metodopagamento_id);

            $encomendaData = $encomenda->toArray();
            $encomendaData['metodoexpedicao'] = $metodoexpedicao;
            $encomendaData['metodopagamento'] = $metodopagamento;
            
            unset($encomendaData['metodoexpedicao_id']);
            unset($encomendaData['metodopagamento_id']);
            unset($encomendaData['userprofile_id']);
            unset($encomendaData['desconto_id']);

            $encomendasWithDetails[] = $encomendaData;
        }

        return $encomendasWithDetails;
    }

    public function actionOne($id)
    {
        $model = new $this->modelClass;

        $request = \Yii::$app->request;

        Yii::$app->response->format = Response::FORMAT_JSON;

        $encomenda = $model::findOne($id);

        $linhasfatura = LinhaFatura::find()->where(['fatura_id' => $encomenda->id])->all();

        $metodoexpedicao = MetodoExpedicao::findOne($encomenda->metodoexpedicao_id);

        $metodopagamento = MetodoPagamento::findOne($encomenda->metodopagamento_id);

        $encomendaData = $encomenda->toArray();
        $encomendaData['linhasfatura'] = $linhasfatura;
        $encomendaData['metodoexpedicao'] = $metodoexpedicao;
        $encomendaData['metodopagamento'] = $metodopagamento;

        return $encomendaData;
    }
}
