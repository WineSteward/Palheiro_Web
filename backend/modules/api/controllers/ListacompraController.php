<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

class ListacompraController extends ActiveController
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

    public $modelClass = 'backend\models\Listacompras';
    public $profileClass = 'common\models\Userprofile';
    public $userClass = 'common\models\User';


    public function actionMy()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $user = $this->userClass::findOne(Yii::$app->params['id']);
        
        $profile = $this->profileClass::find()->where(['user_id' => $user->id])->one();
       
        return $this->modelClass::find()
            ->where(['userprofile_id' => $profile->id])
            ->orderBy(['id' => SORT_ASC])
            ->all();
    }

    public function actionAdd()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = \Yii::$app->request;

        $user = $this->userClass::findOne(Yii::$app->params['id']);
        
        $profile = $this->profileClass::find()->where(['user_id' => $user->id])->one();

        $listaCompras = new $this->modelClass;

        $listaCompras->titulo = $request->getBodyParam('titulo');
        $listaCompras->descricao = $request->getBodyParam('descricao'); 
        $listaCompras->userprofile_id = $profile->id;

        $listaCompras->save();

        return $listaCompras;
    }

    public function actionEdit($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = \Yii::$app->request;
        
        $listaCompras = $this->modelClass::findOne($id);

        $listaCompras->titulo = $request->getBodyParam('titulo');
        $listaCompras->descricao = $request->getBodyParam('descricao'); 

        $listaCompras->save();

        return 'success';
    }
}

