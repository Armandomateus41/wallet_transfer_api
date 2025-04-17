<?php

use App\Controllers\HomeController;
use App\Controllers\TransferController;
use App\Controllers\BalanceController;

// Rota de status
if ($_SERVER['REQUEST_URI'] === '/' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    echo (new HomeController())->index();
}

// Rota de transferência
if (strpos($_SERVER['REQUEST_URI'], '/transfer') === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    (new TransferController())->transfer($data);
}

// Rota de teste (debug)
if (strpos($_SERVER['REQUEST_URI'], '/test-post') === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = json_decode(file_get_contents('php://input'), true);
    echo json_encode([
        'status' => 'ok',
        'received' => $body
    ]);
}

// Nova rota: consultar saldo por ID
if (preg_match('#^/balance/(\d+)$#', $_SERVER['REQUEST_URI'], $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $userId = $matches[1];
    (new BalanceController())->show($userId);
}
