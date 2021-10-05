# API endpoint audit

![ico-laravel]
![ico-php]
![ico-mysql]
![ico-mongodb]
![Software License][ico-license]

This is a Laravel example application build for demo purposes.

The application is a RESTful API exposing some simple endpoints and tracking all incoming requests.

## Installation

To get started, you need to install [Docker Desktop](https://www.docker.com/products/docker-desktop).

Follow the steps below in order to have the application up and running.

#### Clone the repository

```bash
git clone https://github.com/simona-trifan/example-app.git
cd example-app
```
#### Start Docker containers

The application uses [Laravel Sail](https://laravel.com/docs/8.x/sail), which provides a simple command-line interface for interacting with Laravel's default Docker configuration:

```bash
docker-compose up -d
```

The following containers will be created: 

- Laravel Sail (php 7.4)
- MySQL 
- MongoDB ([bitnami/mongodb](https://github.com/bitnami/bitnami-docker-mongodb))

#### Install the dependencies
```bash
docker exec example-app_laravel.test_1 composer install
```

#### Create the .env file
```bash
cp .env.example .env
```

#### Run the migrations and seeds
```bash
vendor/bin/sail php artisan migrate

vendor/bin/sail php artisan db:seed
```

This will create:
- **users** table in MySQL database, seeded with 10 users
- **logs** table in MongoDb database

#### Run the application

You can access the application in your web browser at: [http://localhost/logs](http://localhost/logs).

## Usage

The application exposes both endpoints protected by an authentication layer (Bearer token), and public endpoints.

[Swagger file](swagger.yaml)

- GET /token
- GET /logs
- GET /me -> authentication needed

#### Obtain an access token
```bash
curl -X 'GET' \
  'http://localhost/token?email=ivory.purdy%40example.net&password=password' \
  -H 'accept: application/json' 
```

#### Get the current user
```bash
curl -X 'GET' \
  'http://localhost/me' \
  -H 'accept: application/json' \
  -H 'Authorization: Bearer [REPLACE_WITH_ACCESS_TOKEN_OBTAINED_PREVIOUSLY]'
```

#### Search logs
```bash
curl -X 'GET' \
  'http://localhost/logs?order-by=created_at&order=desc&per-page=10&page=1' \
  -H 'accept: application/json'
```

## Development notes

#### Authentication

For demo purposes only, the application uses a simple Token based authentication (JWT Bearer token). For live applications more complex authentication mechanisms are recommended.

#### Audit data

The application uses a request middleware to log all the incoming requests and store them in the database. For demo purposes only, the IP address and user agent are stored, but more complex applications should store more relevant data (routes, request headers, response body etc.), provide a way to skip some endpoints from being logged etc.

#### Database

A MongoDB database is used for storing the logs, instead of the common MySQL database, for speed (no relations integrity checks) and scalability reasons and also for future improvements like using the sharding feature provided by MongoDB to distribute the log data across multiple shards.

[ico-php]: https://img.shields.io/badge/php-%5E7.4-blue
[ico-laravel]: https://img.shields.io/badge/laravel-%5E8.54-blue
[ico-mysql]: https://img.shields.io/badge/mysql-8.0-blue
[ico-mongodb]: https://img.shields.io/badge/mongodb-latest-blue
[ico-license]: https://img.shields.io/badge/License-Apache%202.0-green.svg
