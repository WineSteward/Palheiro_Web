<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

class MetodopagamentoController extends ActiveController
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
        if (Yii::$app->params['id'] == 0)
        {
            throw new \yii\web\ForbiddenHttpException('Proibido');
        }
    }

    public $modelClass = 'common\models\Metodopagamento';

    public function actionAll()
    {
        $model = new $this->modelClass;
        
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $model::find()
                        ->where(['vigor' => '1'])    
                        ->orderBy(['id' => SORT_ASC])
                        ->all();
    }
}
