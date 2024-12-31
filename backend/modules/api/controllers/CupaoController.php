<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use common\models\Carrinho;
use common\models\Desconto;
use common\models\User;
use common\models\Userdesconto;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

class CupaoController extends ActiveController
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

    public $modelClass = 'common\models\Desconto';
    public $userClass = 'common\models\User';


    public function actionMy()
    {
        $model = new $this->modelClass;
    
        Yii::$app->response->format = Response::FORMAT_JSON;
    
        $user = $this->userClass::find()->where(['id' => Yii::$app->params['id']])->one();
    
        $userDescontos = Userdesconto::find()
            ->where(['userprofile_id' => $user->userprofile->id])
            ->andWhere(['valido' => 1])
            ->all();
    
        $cupoes = [];
    
        foreach ($userDescontos as $cupao) 
        {
            $desconto = $this->modelClass::findOne($cupao->desconto_id);
    
            if ($desconto) 
            {
                $cupoesData = [];
                $cupoesData['id'] = $cupao->id;
                $cupoesData['nome'] = $desconto->nome;
                $cupoes[] = $cupoesData;
            }
        }
    
        return $cupoes;
    }
    

    public function actionValidate()
    {
        $model = new $this->modelClass;

        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = \Yii::$app->request;

        $descontoNome = $request->getQueryParam('descontoNome');

        $user = $this->userClass::find()->where(['id' => Yii::$app->params['id']])->one();

        $descontos = Userdesconto::find()
            ->where(['userprofile_id' => $user->userprofile->id])
            ->andWhere(['valido' => 1])
            ->all();

        foreach ($descontos as $desconto) 
        {
            $descontoAtual = Desconto::findOne($desconto->desconto_id);

            if ($descontoAtual->nome == $descontoNome) {

                $carrinho = Carrinho::findOne($user->userprofile->carrinho_id);

                $placeholderTotal = $carrinho->total - ($carrinho->total * (1 / $descontoAtual->valor));

                return ['isValid' => true, 'novoTotal' => $placeholderTotal];
            }
        }

        return ['isValid' => false];
    }
}
