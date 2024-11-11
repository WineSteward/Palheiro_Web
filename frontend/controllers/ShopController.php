<?php

namespace frontend\controllers;

use common\models\Produto;
use common\models\Categoria;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ShopController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $produtos = Produto::find()->all();
        $categorias = Categoria::find()->all();

        return $this->render('index',[
            'produtos' => $produtos,
            'categorias' => $categorias,
            ]);
    }

}
