# Laravel


Running project:

```
docker compose up -d
```

Stop project:

```
docker compose down -v
```

Install specific package:

```
docker compose exec app composer require <package_name>
```

Commands:
```
docker compose exec app composer install

docker compose exec app php artisan key:generate

docker compose exec app php artisan migrate
```