# Symfony api test project

## Installation

```sh
git clone https://github.com/laravel7dev/symfony-api.git testproject
cd testproject
cp .env.example .env
```

```sh
docker-compose build app
docker-compose up -d
```

```sh
docker-compose exec app composer install
docker-compose exec app php bin/console doctrine:migrations:migrate
```

```sh
docker-compose exec db bash -c "mysql lambda_db -u lambda_user -ppassword < /dump/dump.sql"
```

Verify the deployment by navigating to http://localhost:8000/api address in
your preferred browser.

```sh
http://localhost:8000/api
```


## Using

Test CRUD endpoints:
```sh
http://localhost:8000/api
```

Getting product price by location.
Examples:

```sh
http://localhost:8000/api/products/1/en
http://localhost:8000/api/products/2/en
http://localhost:8000/api/products/1/fr
http://localhost:8000/api/products/2/fr
```