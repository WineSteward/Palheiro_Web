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
                        'actions' => ['returnimage'],
                        'allow' => true,
                        'roles' => ['@', '?'],
                    ],
                ],
            ]
        ];
    }

    public function actionReturnimage($imageName)
    {

        $path = Yii::getAlias('@backend/web/company/') . $imageName;
        if (file_exists($path)) 
        {
            Yii::$app->response->sendFile($path);
            return;
        }
        throw new \yii\web\NotFoundHttpException('Image not found.');
    
    }

}
