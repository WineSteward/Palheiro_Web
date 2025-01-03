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
                //transformacao dos dados em um formato like JSON para que possam ser enviados inline
                $message = "nome:" . $model->name . ",email:" . $model->email .",titulo:" . $model->subject . ",corpo:" . $model->body;
                
                // Criar a instancia do cliente publisher
		$mqtt = new MqttClient('172.22.21.209', 1883);
                
                //mosquitto_pub
                $mqtt->publish('contactos', $message);
                
                Yii::$app->session->setFlash('success', 'Obrigado por nos contactar. Iremos responder com a máxima brevidade. Obrigado.');
            }
            catch (\Exception $e) 
            {
                Yii::$app->session->setFlash('error', 'Aconteceu um erro ao enviar a sua mensagem. Volte a tentar mais tarde. Agradecemos a atenção');
            }
    
            return $this->refresh();
        }
    
        return $this->render('index', [
            'model' => $model,
        ]);
    }
    
}
