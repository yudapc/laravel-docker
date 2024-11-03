# Project Todo Documentations

Generate key

```
docker compose exec app php artisan key:generate
```

Histories

```
docker compose exec app php artisan make:model Category -m
docker compose exec app php artisan make:model Todo -m
sudo chown -R $USER:$USER site
## update .env DB_CONNECTION=mariadb
docker compose exec app php artisan migrate
docker compose exec app php artisan make:controller CategoryController --resource
docker compose exec app php artisan make:controller TodoController --resource
docker compose exec app php artisan route:list
```
