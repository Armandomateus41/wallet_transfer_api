<?php

namespace App\Services;

use PDO;
use Exception;

class TransferService
{
    private $pdo;

    public function __construct()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $dsn = "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}";
        $this->pdo = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function execute(array $data)
    {
        $payerId = $data['payer'];
        $payeeId = $data['payee'];
        $value = $data['value'];

        if ($payerId === $payeeId) {
            throw new Exception("Pagador e recebedor não podem ser iguais.");
        }

        $this->pdo->beginTransaction();

        $payer = $this->getUser($payerId);
        $payee = $this->getUser($payeeId);

        if (!$payer || !$payee) {
            throw new Exception("Usuário não encontrado.");
        }

        if ($payer['type'] !== 'common') {
            throw new Exception("Apenas usuários comuns podem realizar transferências.");
        }

        if ($payer['balance'] < $value) {
            throw new Exception("Saldo insuficiente.");
        }

        // Chamada ao serviço de autorização
        $auth = file_get_contents('https://util.devi.tools/api/v2/authorize');
        $authResponse = json_decode($auth, true);

        if ($authResponse['message'] !== 'Autorizado') {
            throw new Exception("Transação não autorizada pelo serviço externo.");
        }

        // Atualiza saldos
        $this->updateBalance($payerId, $payer['balance'] - $value);
        $this->updateBalance($payeeId, $payee['balance'] + $value);

        // Grava transação
        $stmt = $this->pdo->prepare("INSERT INTO transactions (value, payer_id, payee_id) VALUES (?, ?, ?)");
        $stmt->execute([$value, $payerId, $payeeId]);

        $this->pdo->commit();

        // Notifica (mesmo que falhe, não afeta a transação)
        @file_get_contents('https://util.devi.tools/api/v1/notify');

        return ['status' => 'success', 'message' => 'Transferência realizada com sucesso.'];
    }

    private function getUser($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function updateBalance($id, $newBalance)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET balance = ? WHERE id = ?");
        $stmt->execute([$newBalance, $id]);
    }
}
