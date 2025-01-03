<?php
namespace console\controllers;

use common\models\Mensagem;
use yii\console\Controller;

class MqttController extends Controller
{
    const TOPIC = 'contactos';

    //processo esta constantemente a correr no nosso servidor pois está sempre a escuta de msgs
    public function actionSubscribe()
    {
        // Preparação do comando para usar no CMD
        $cmd = "mosquitto_sub -q 1 -t " . self::TOPIC;

        //Inicialização do processo de leitura das msgs
        $process = popen($cmd, 'r');

        // Quando recebe uma nova msg vai processa-la
        while ($message = fgets($process)) {
            $this->processMessage($message);
        }

        // Termina o CMD
        fclose($process);
    }

    private function processMessage($message)
    {
        // Parse da msg de JSON like structure para dados que possam ser usados no nosso modelo da msg
        $messageData = $this->parseMessage($message);

        // Guardar os dados na nossa base de dados
        $this->storeMessage($messageData);
    }

    private function parseMessage($message)
    {
        //separação dos campos de dados com uso de virgulas e do key => value com uso de dois pontos
        $data = [];
        $parts = explode(',', $message);
        
        foreach ($parts as $part) {
            list($key, $value) = explode(':', trim($part));
            $data[trim($key)] = trim($value);
        }

        return $data;
    }

    private function storeMessage($messageData)
    {
        //criar um novo modelo com os dados recebidos
        $messagem = new Mensagem();
        $messagem->nome = $messageData['nome'];
        $messagem->email = $messageData['email'];
        $messagem->titulo = $messageData['titulo'];
        $messagem->corpo = $messageData['corpo'];
        
        if ($messagem->save()) {
            echo "Mensagem guardada: " . json_encode($messageData) . "\n";
        } else {
            echo "Erro ao gravar a mensagem: " . json_encode($messageData) . "\n";
        }
    }
}
