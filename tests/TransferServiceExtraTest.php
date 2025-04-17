<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Services\TransferService;

class TransferServiceExtraTest extends TestCase
{
    private TransferService $service;

    protected function setUp(): void
    {
        $this->service = new TransferService();
    }

    public function testShouldFallbackIfAuthorizationFails(): void
    {
        $data = [
            'payer' => 3,  // Armando Mateus (common com saldo)
            'payee' => 2,  // Loja Exemplo (merchant)
            'value' => 0.01  // Valor baixo para simular e não afetar saldo
        ];

        $result = $this->service->execute($data);

        var_dump($result); 

        $this->assertIsArray($result);
        $this->assertArrayHasKey('status', $result);
        $this->assertEquals('success', $result['status']);
    }

    public function testShouldTransferSuccessfullyWithValidData(): void
    {
        $data = [
            'payer' => 3,  // Armando Mateus
            'payee' => 2,  // Loja Exemplo
            'value' => 1.00
        ];

        $result = $this->service->execute($data);

        var_dump($result); 

        $this->assertIsArray($result);
        $this->assertArrayHasKey('status', $result);
        $this->assertEquals('success', $result['status']);
    }
}
