# Wallet Transfer API

API RESTful para simular transferências de saldo entre usuários comuns e lojistas. Projeto realizado como parte de um desafio técnico para backend PHP.

---

##  Funcionalidades

- Transferência entre usuários com validação de saldo
- Apenas usuários do tipo `common` podem transferir
- Lojistas (`merchant`) só podem receber
- Verificação com serviço externo de autorização (com fallback seguro)
- Registro de transações
- Consulta de saldo por ID
- Envio de notificação (simulada)
- Estrutura desacoplada com Controllers e Services
- Docker para desenvolvimento local completo

---

##  Tecnologias Utilizadas

- PHP 8.2
- MySQL 8
- Docker e Docker Compose
- Composer
- Dotenv
- PSR-4 Autoloading

---

##  Como executar localmente

```bash
git clone https://github.com/Armandomateus41/wallet_transfer_api.git
cd wallet_transfer_api
docker-compose up -d --build
docker exec -it picpay_app composer install
