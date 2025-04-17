<?php

namespace App\Controllers;

use App\Services\TransferService;

class TransferController
{
    public function transfer(array $data)
    {
        try {
            $service = new TransferService();
            $result = $service->execute($data);

            http_response_code(200);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
