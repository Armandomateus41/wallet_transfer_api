<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Services\TransferService;

class TransferServiceTest extends TestCase
{
    private TransferService $service;

    protected function setUp(): void
    {
        $this->service = new TransferService();
    }

    public function testShouldReturnErrorWhenPayerEqualsPayee(): void
    {
        $this->assertTrue(true); // ← Teste mínimo para confirmar execução

        $data = [
            'payer' => 1,
            'payee' => 1,
            'value' => 100.00
        ];

        $result = $this->service->execute($data);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Pagador e recebedor não podem ser iguais.', $result['error']);
    }
}
