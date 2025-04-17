# Wallet Transfer API

Uma API RESTful simplificada para transferência de saldo entre usuários comuns e lojistas, desenvolvida com PHP puro, Docker e MySQL. Este projeto simula uma carteira digital com integração a serviços externos para autorização e notificação.

---

##  Funcionalidades

- Cadastro de usuários comuns e lojistas (via SQL)
- Transferência de saldo entre usuários
- Validação de tipo de usuário e saldo
- Chamada a serviço externo de autorização (`GET`)
- Notificação simulada de transferência (`POST`)
- Transações atômicas com rollback em caso de erro

---

##  Tecnologias Utilizadas

- PHP 8.2 (Apache)
- Docker / Docker Compose
- MySQL 8
- Composer
- PSR-4 Autoload
- Dotenv
- RESTful Design

---

##  Como executar localmente

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/nome-do-repositorio.git
cd nome-do-repositorio
