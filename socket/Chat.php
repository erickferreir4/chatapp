<?php 

namespace app;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later

        $querystring = $conn->httpRequest->getUri()->getQuery();
        $id = explode('=', $querystring)[1];

        $conn->resourceId = $id;
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $json) {

        $msg = json_decode($json)->msg;
        $id = json_decode($json)->id;
        //var_dump($msg, $id);

        echo sprintf('Connection %d sending message "%s" to %d other connection' . "\n"
            , $from->resourceId, $msg, $id );

        foreach ($this->clients as $client) {
            if ($id === $client->resourceId) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
