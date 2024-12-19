<?php

namespace frontend\controllers;

use common\models\Carrinho;
use common\models\Userprofile;
use common\models\Linhacarrinho;
use Yii;

class CarrinhoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']); // Redirect if not logged in
        }

        $user = Yii::$app->user->identity;
        // Retrieve the user profile associated with the current user
        // $userProfile = $user->userprofile;
        $userProfile = UserProfile::findOne(['user_id' => $user->id]);

        if (!$userProfile || !$userProfile->carrinho_id) {
            Yii::$app->session->setFlash('error', 'Carrinho not found.');
            return $this->redirect(['produto/index']); // Redirect to a safe page
        }

        // Fetch the Carrinho using carrinho_id from the user profile
        $carrinho = Carrinho::findOne($userProfile->carrinho_id);

        if (!$carrinho) {
            Yii::$app->session->setFlash('error', 'Carrinho not found.');
            return $this->redirect(['produto/index']); // Redirect to a safe page
        }
        $carrinho->updateTotal();
        // Retrieve all LinhasCarrinho associated with this Carrinho
        $linhasCarrinho = LinhaCarrinho::find()->where(['carrinho_id' => $carrinho->id])->all();

        return $this->render('index', [
            'carrinho' => $carrinho,
            'linhascarrinhos' => $linhasCarrinho,
        ]);
    }

}
