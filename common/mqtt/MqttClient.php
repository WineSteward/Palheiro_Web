<?php

namespace common\mqtt;

class MqttClient
{
    private $host;
    private $port;

    //construcao do nosso mosquitto_pub
    public function __construct($host = 'localhost', $port = 1883)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function publish($topic, $message)
    {
        // Garantir que os dados nao vem com intencoes maliciosas
        $escapedMessage = escapeshellarg($message);

        // preparacao do comando mosquitto_pub com base nos dados recebidos e nos dados do construtor da instancia
        $command = sprintf(
            'mosquitto_pub -r -q 1 -h %s -p %d -t "%s" -m %s',
            escapeshellarg($this->host),
            $this->port,
            escapeshellarg($topic),
            $escapedMessage
        );

        // Execução do comando no CMD
        $output = [];
        $returnVar = 0;
        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            throw new \Exception("Falha ao publicar o seu formulário");
        }
    }
}
