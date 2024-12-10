<?php

namespace backend\controllers;

use common\models\Imagem;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\FileHelper;
use yii\helpers\Url;

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
                    [
                        'actions' => ['deleteimage'],
                        'allow' => true,
                        'roles' => ['admin'],
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



    /**
     * Delete the product image file and its database entry.
     * 
     * @return string|\yii\web\Response
     */
    public function actionDeleteimage($id, $imageName)
    {
        $imagePath = Yii::getAlias('@backend/web/products/' . $imageName);

        // Delete the file from the server
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        
        $image = Imagem::findOne($id);

        // Delete the record from the database
        $image->delete();
        
        return $this->redirect(Url::to(['produto/index']));
    }

}
