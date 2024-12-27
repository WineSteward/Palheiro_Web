<?php

namespace frontend\controllers;

use common\mqtt\MqttClient;
use Yii;
use yii\web\Controller;
use frontend\models\ContactForm;

class ContactController extends Controller
{
    public function actionIndex()
    {
        $model = new ContactForm();
    
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $rawMessage = "nome:" . $model->name . ",email:" . $model->email .",titulo:" . $model->subject . ",corpo:" . $model->body;
                
                $mqtt = new MqttClient('localhost', 1883);
                
                $mqtt->publish('contactos', $rawMessage);
                
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            }
            catch (\Exception $e) 
            {
                Yii::$app->session->setFlash('error', 'There was an error sending your message: ' . $e->getMessage());
            }
    
            return $this->refresh();
        }
    
        return $this->render('index', [
            'model' => $model,
        ]);
    }
    
}
