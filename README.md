Template de backend com PHP 8.4 e Laravel 12. 

Já deixei pronto:
- Autenticação
- Estrutura base de desenvolvimento
- Linter, PHP Stan e testes

Esse backend Roda na porta 8080. 

Para iniciar, rode:
```bash
    cp .env.example .env
    cp config/develop/docker/docker-compose.yml docker-compose.yml
    docker compose up -d
    make
    composer install
    php artisan key:generate
```
