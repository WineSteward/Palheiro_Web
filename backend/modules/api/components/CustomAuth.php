<?php

namespace backend\modules\api\components;

use Yii;
use yii\filters\auth\AuthMethod;

class CustomAuth extends AuthMethod
{
    public function authenticate($user, $request, $response)
    {
        $authToken = $request->getQueryParams('access-token');
        
        //getQueryString()
        //$token = explode('=', $authToken)[1];
        
        $user = \common\models\User::findIdentityByAccessToken($authToken);
        
        if(Yii::$app->authManager->checkAccess($user->id, "admin") || Yii::$app->authManager->checkAccess(Yii::$app->params['id'], "employee"))
            throw new \yii\web\ForbiddenHttpException('No authentication'); //403
            
        if (!$user)
            throw new \yii\web\ForbiddenHttpException('No authentication'); //403
        

        Yii::$app->params['id'] = $user->id;
        return $user;
    }
}
