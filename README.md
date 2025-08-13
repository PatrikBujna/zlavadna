## Users & Teams Admin (Laravel + Sail)

Lightweight admin app to manage Users and Teams with SOLID-ish layering (Handlers, Factories, Repositories) and a simple Bootstrap UI.

### Setup
1) Start containers and install deps
   - ./vendor/bin/sail up -d
   - ./vendor/bin/sail composer install

2) Env and app key
   - cp .env.example .env
   - ./vendor/bin/sail artisan key:generate

3) Migrate and seed
   - ./vendor/bin/sail artisan migrate:fresh --seed

4) Open admin UI
   - http://localhost/admin/users
