# Wallet Transfer API

API RESTful para simular transferências de saldo entre usuários comuns e lojistas. 
Projeto realizado como parte de um desafio técnico para backend PHP.

---

##  Funcionalidades

- Transferência entre usuários com validação de saldo
- Apenas usuários do tipo `common` podem transferir
- Lojistas (`merchant`) só podem receber
- Verificação com serviço externo de autorização (com fallback seguro)
- Registro de transações
- Consulta de saldo por ID (`GET /balance/{id}`)
- Envio de notificação simulada
- Estrutura desacoplada com Controllers e Services
- Docker para ambiente de desenvolvimento

---

## Tecnologias Utilizadas

- PHP 8.3 (com Apache)
- MySQL 8
- Docker e Docker Compose
- Composer (autoload PSR-4)
- Dotenv para variáveis de ambiente
- PHPUnit 12 para testes automatizados

---

## Como executar localmente

```bash
git clone https://github.com/Armandomateus41/wallet_transfer_api.git
cd wallet_transfer_api
docker-compose up -d --build
docker exec -it picpay_app composer install
```

Acesse a aplicação em:  
 `http://localhost:8000`

---

##  Endpoints

### `POST /transfer`

Realiza transferência entre dois usuários.

#### Requisição:
```json
{
  "value": 100.0,
  "payer": 3,
  "payee": 2
}
```

#### Resposta:
```json
{
  "status": "success",
  "message": "Transferência realizada com sucesso."
}
```

---

### `GET /balance/{id}`

Consulta o saldo de um usuário.

#### Exemplo:
`GET http://localhost:8000/balance/3`

#### Resposta:
```json
{
  "id": 3,
  "name": "Armando Mateus",
  "balance": "4999,00"
}
```

---

##  Testes Automatizados

Testes escritos com PHPUnit 12.x para garantir a lógica de negócio:

 `TransferServiceTest.php`      
`TransferServiceExtraTest.php` 

## O que cobre   
`Fallback de autorização e transações reais`
` Regras de negócio, erros de entrada `

### Como rodar os testes:

 Dentro do container:

```bash
docker exec -it picpay_app vendor/bin/phpunit
```

 Ou apenas um arquivo:

```bash
docker exec -it picpay_app vendor/bin/phpunit tests/TransferServiceExtraTest.php
```

---


---

##  Contato

Desenvolvido por **Armando Mateus**  
[LinkedIn](https://linkedin.com/in/armandocapita)  
armandomateus41@gmail.com
