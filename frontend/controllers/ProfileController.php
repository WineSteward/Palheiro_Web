<?php

namespace frontend\controllers;

use common\models\Userdesconto;
use common\models\Fatura;
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
            ->andWhere(['valido' => 1])
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

    public function actionEdit()
    {
        $user = Yii::$app->user->identity;
        $userProfile = $user->userprofile;

        return $this->render('edit', [
            'user'=>$user,
            'userProfile' => $userProfile,
        ]);
    }

    /**
     * Updates an existing Userprofile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        //TRANSACTIONS!!!!!!!!!!!!!!!!!!!!!!!!!

        $user = Yii::$app->user->identity;
        $userprofile = $user->userprofile;

        if ($this->request->isPost &&$userprofile->load($this->request->post()) && $userprofile->save())
        {
            Yii::$app->session->setFlash('success', 'Perfil editado com sucesso.');
            return $this->redirect(['index']);
        }
    }

}
