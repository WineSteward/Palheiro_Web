<?php

namespace common\mqtt;

class MqttClient
{
    private $host;
    private $port;

    public function __construct($host = 'localhost', $port = 1883)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function publish($topic, $message)
    {
        // Directly escape the message to preserve spaces and special characters
        $escapedMessage = escapeshellarg($message);  // Escape the message but keep spaces

        // Prepare the command for mosquitto_pub
        $command = sprintf(
            'mosquitto_pub -r -q 1 -h %s -p %d -t "%s" -m %s',
            escapeshellarg($this->host),
            $this->port,
            escapeshellarg($topic),
            $escapedMessage
        );

        // Execute the command
        $output = [];
        $returnVar = 0;
        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            throw new \Exception("Failed to publish message. Command output: " . implode("\n", $output));
        }
    }
}
