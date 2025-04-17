<?php

use App\Controllers\HomeController;
use App\Controllers\TransferController;

if ($_SERVER['REQUEST_URI'] === '/' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    echo (new HomeController())->index();
}

if ($_SERVER['REQUEST_URI'] === '/transfer' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    (new TransferController())->transfer($data);
}
