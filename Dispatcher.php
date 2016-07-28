<?php namespace Terminal;

use Bunny\Client;
use Example\Config;

class Dispatcher {

    /** @var Config */
    private $config;

    public function __construct(Config $config) {
        $this->config = $config;
    }

    public function dispatch($event, $payload) {
        $message = json_encode([
            'name' => $event,
            'payload' => json_encode($payload),
            'time' => date('U')
        ]);

        $client = new Client($this->config->toArray());
        $client->connect();
        $channel = $client->channel();
        $channel->queueDeclare($this->config->queueName());
        $channel->publish($message, [], '', $this->config->queueName());

        echo "sent: " . $message . "\n";
    }
}
