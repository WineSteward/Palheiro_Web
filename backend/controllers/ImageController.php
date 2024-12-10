<?php

namespace backend\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\FileHelper;

class ImageController extends Controller
{

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['company', 'products'],
                        'allow' => true,
                        'roles' => ['@', '?'],
                    ],
                ],
            ]
        ];
    }

    public function actionCompany($imageName)
    {

        $path = Yii::getAlias('@backend/web/company/') . $imageName;
        if (file_exists($path)) 
        {
            Yii::$app->response->sendFile($path);
            return;
        }
        throw new \yii\web\NotFoundHttpException('Image not found.');
    
    }


    public function actionProducts($imageName)
    {

        $path = Yii::getAlias('@backend/web/products/') . $imageName;
        if (file_exists($path)) 
        {
            Yii::$app->response->sendFile($path);
            return;
        }
        throw new \yii\web\NotFoundHttpException('Image not found.');
    
    }

}
