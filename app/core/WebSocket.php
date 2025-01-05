<?php
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require_once __DIR__ . '/../../vendor/autoload.php';

class PaymentSocket implements MessageComponentInterface {
    protected $clients;
    protected $adminClients;

    public function __construct() {
        $this->clients = [];
        $this->adminClients = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        // Lưu connection ID
        $query = $conn->httpRequest->getUri()->getQuery();
        parse_str($query, $params);

        if (isset($params['type']) && $params['type'] === 'admin') {
            $this->adminClients[$conn->resourceId] = $conn;
            $conn->send(json_encode(['type' => 'admin_connected']));
        } else if (isset($params['type']) && $params['type'] === 'user') {
            $this->clients[$params['userId']] = $conn;
            $conn->send(json_encode(['type' => 'user_connected']));
        } else {
            $conn->close();
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $from->send(json_encode(['type' => 'error', 'message' => 'Invalid JSON']));
            return;
        }

        switch ($data['type']) {
            case 'payment_success':
                foreach ($this->adminClients as $admin) {
                    $admin->send(json_encode([
                        'type' => 'new_payment',
                        'data' => $data['payment']
                    ]));
                }
                break;

            case 'admin_response':
                $userId = $data['clientId'];
                if ($userId && isset($this->clients[$userId])) {
                    $this->clients[$userId]->send(json_encode([
                        'type' => 'payment_response',
                        'data' => $data['response']
                    ]));
                }
                break;

            default:
                $from->send(json_encode(['type' => 'error', 'message' => 'Unknown message type']));
                break;
        }
    }

    public function onClose(ConnectionInterface $conn) {
        unset($this->clients[$conn->resourceId]);
        unset($this->adminClients[$conn->resourceId]);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new PaymentSocket()
        )
    ),
    8080
);

$server->run();