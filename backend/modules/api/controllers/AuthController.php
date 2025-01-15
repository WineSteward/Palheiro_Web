<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\rest\ActiveController;

class AuthController extends ActiveController
{
    public $modelClass = "common\models\LoginForm";
    public $modelUser = "common\models\User";

    public function actionLogin()
    {
        $model = new $this->modelClass;

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = \Yii::$app->request;

        $username = $request->getBodyParam('username');
        $password = $request->getBodyParam('password');
        
        $user = $model->loginAPI($username, $password);
        if ($user)
        {

            if (Yii::$app->authManager->checkAccess($user->id, "admin") || Yii::$app->authManager->checkAccess($user->id, "employee")) {
                return ['token' => ""];
            }

            return ['token' => $user->auth_key];
        }

        return ['token' => ""];
    }

    /**
     * Logout action.
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
    }
}
