<?php

namespace frontend\controllers;

use common\models\Userdesconto;
use common\models\Fatura;
use common\models\User;
use common\models\Userprofile;
use Yii;

class ProfileController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // User que esta loged in
        $user = Yii::$app->user->identity;
        $userProfile = $user->userprofile;

        if (!$userProfile) {
            Yii::$app->session->setFlash('error', 'Utilizador não encontrado.');
            return $this->redirect(['/site/index']);
        }

        $userDescontos = Userdesconto::find()
            ->where(['userprofile_id' => $userProfile->id])
            ->with('desconto')
            ->all();
        $faturas = Fatura::find()
            ->where(['userprofile_id' => $userProfile->id, 'valida' => 1])
            ->all();

        return $this->render('index', [
            'user'=>$user,
            'userProfile' => $userProfile,
            'userDescontos' => $userDescontos,
            'faturas' => $faturas,
        ]);
    }

    public function actionEditarProfile()
    {
        $user = Yii::$app->user->identity;
        $userProfile = $user->userprofile;

    }


}
