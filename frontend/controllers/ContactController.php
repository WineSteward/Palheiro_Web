<?php

namespace frontend\controllers;

use frontend\models\ContactForm;
use Yii;

class ContactController extends \yii\web\Controller
{
    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if (/*$model->sendEmail(Yii::$app->params['adminEmail'])*/true)
            {
                //msg sent to mosquitto OK
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            }
            else
            {
                //something went wrong
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }


}
