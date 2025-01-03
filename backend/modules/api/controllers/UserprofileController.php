<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use common\models\Carrinho;
use common\models\User;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

class UserprofileController extends ActiveController
{
    public function behaviors()
    {
        Yii::$app->params['id'] = 0;
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CustomAuth::className(),
            'except' => ['registar']
        ];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if (Yii::$app->params['id'] == 0) {
            throw new \yii\web\ForbiddenHttpException('Proibido');
        }
    }

    public $modelClass = 'common\models\Userprofile';
    public $userClass = 'common\models\User';
    public $modelSignupUser = 'common\models\SignupFormUser';
    public $modelSignupUserprofile = 'common\models\SignupFormUserProfile';
    public $modelCarrinho = 'common\models\Carrinho';

    public function actionOne()
    {
        $model = new $this->modelClass;

        $request = \Yii::$app->request;

        Yii::$app->response->format = Response::FORMAT_JSON;

        $user = $this->userClass::findOne(Yii::$app->params['id']);

        $userprofile = $this->modelClass::findOne(['user_id' => $user->id]);

        $userData = $userprofile->toArray();
        $userData['username'] = $user->username;
        $userData['email'] = $user->email;

        return $userData;
    }

    public function actionEdit()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = \Yii::$app->request;

        $morada = $request->getBodyParam('morada');
        $morada2 = $request->getBodyParam('morada2');
        $codigoPostal = $request->getBodyParam('codigoPostal');

        $user = $this->userClass::findOne(Yii::$app->params['id']);

        $profile = $this->modelClass::findOne(['user_id' => $user->id]);

        $profile->morada = $morada;
        $profile->morada2 = $morada2;
        $profile->codigoPostal = $codigoPostal;

        if($profile->save())
            return ['response' => 'success'];
            
    }


    public function actionRegistar()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = \Yii::$app->request;

        $userForm = new $this->modelSignupUser;
        $userprofile = new $this->modelSignupUserprofile;

        $userData = [
            'SignupFormUser' => [
                'username' => $request->getBodyParam('username') ?? null,
                'email' => $request->getBodyParam('email') ?? null,
                'password' => $request->getBodyParam('password') ?? null,
            ],
        ];

        $profileData = [
            'SignupFormUserprofile' => [
                'morada' => $request->getBodyParam('morada') ?? null,
                'morada2' => $request->getBodyParam('morada2') ?? null,
                'codigoPostal' => $request->getBodyParam('codigoPostal') ?? null,
                'nif' => $request->getBodyParam('NIF') ?? null,
            ],
        ];
        
        $userprofile->attributes = $profileData['SignupFormUserprofile'];

        if ($userForm->load($userData) && $userprofile->validate() && $userForm->signup()) 
        {
            $carrinho = Carrinho::defaultCarrinho();

            if ($userprofile->signup($userForm->id, $carrinho)) {
                $user = User::findOne($userForm->id);
                return ['token' => $user->auth_key];
            }
        }

        return 'error';
    }
}
