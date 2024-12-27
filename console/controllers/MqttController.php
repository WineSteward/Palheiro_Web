<?php
namespace console\controllers;

use common\models\Mensagem;
use Yii;
use yii\console\Controller;
use yii\db\Query;

class MqttController extends Controller
{
    // Define the topic to listen to
    const TOPIC = 'contactos';

    public function actionSubscribe()
    {
        // Prepare the command for mosquitto_sub
        $cmd = "mosquitto_sub -q 1 -t " . self::TOPIC;

        // Open the process to read messages
        $process = popen($cmd, 'r');  // Open the command for reading its output

        // Read the messages and process them
        while ($message = fgets($process)) {
            $this->processMessage($message);  // Process the incoming message
        }

        // Close the process after done
        fclose($process);
    }

    private function processMessage($message)
    {
        // Parse the raw message (assuming it's in the format: "name: John, email: john@example.com, message: Hello")
        $messageData = $this->parseMessage($message);

        // Store the message data in the database
        $this->storeMessage($messageData);
    }

    private function parseMessage($message)
    {
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
        $messagem = new Mensagem();
        $messagem->nome = $messageData['nome'];
        $messagem->email = $messageData['email'];
        $messagem->titulo = $messageData['titulo'];
        $messagem->corpo = $messageData['corpo'];
        
        if ($messagem->save()) {
            echo "Message saved successfully: " . json_encode($messageData) . "\n";
        } else {
            echo "Failed to save message: " . json_encode($messageData) . "\n";
        }
    }
}
