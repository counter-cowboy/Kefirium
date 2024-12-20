.PHONY: help build up start down destroy stop restart logs logs-api ps login-timescale login-api db-shell


env:
	mv /src/.env.example /src/.env
build:
	docker compose build
up:
	docker compose up -d --build
down:
	docker compose down
logs:
	docker compose  logs --tail=100 -f $(c)
ps:
	docker ps -a
migrate:
	docker exec -it php php8 artisan migrate
fresh:
	docker exec -it php php8 artisan migrate:fresh
seed:
	docker exec -it php php8 artisan db:seed
fresh-seed:
	docker exec -it php php8 artisan migrate:fresh --seed
test:
	docker exec -it php php8 artisan test
testdb:
	docker exec -it pgsql createdb -U user nft_test
	
  
  
# для миграции и сидирования баз данных
PHP=php
ARTISAN=php artisan

# Основная БД
MIGRATE_MAIN=$(ARTISAN) migrate --database=pgsql
SEED_MAIN=$(ARTISAN) db:seed --database=pgsql

# Тестовая БД
MIGRATE_TEST=$(ARTISAN) migrate --database=pgsql_test
SEED_TEST=$(ARTISAN) db:seed --database=pgsql_test

db:	
	@echo "Running migrations and seed for main database..."
	docker exec -it php8 $(MIGRATE_MAIN)
	docker exec -it php8 $(SEED_MAIN)
	@echo "Running migrations and seed for test database..."
	docker exec -it php8 $(MIGRATE_TEST)
	docker exec -it php8 $(SEED_TEST)
	@echo "Migrations and seed completed."
