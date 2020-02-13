SerialiXample
=============

JMS Serializer Subscriber example with Symfony 4.4

[TL;DR](https://gist.github.com/allucardster/86073426076bc49822a9f488d6cc26ff)

Requirements
============

- Docker `>= 18.x`
- Docker Compose `>= 1.24.x`

Stack
=====

- PHP 7.4
- Symfony 4.4
- MySQL 8.0.19
- Nginx:1.17.8

Setup
=====

- Build the containers with:

```sh
$ docker-compose up -d
```

- Install PHP depencencies with:

```sh
$ docker-compose exec php composer install 
```

- Execute database migrations

```sh
$ docker-compose exec php ./bin/console doctrine:migrations:migrate --no-interaction
```

- Load data fixtures

```sh
$ docker-compose exec php ./bin/console doctrine:fixtures:load --purge-with-truncate --no-interaction
```

- Open http://localhost:8080/api/product in a web browser (Chrome, Firefox, etc)

Contributors
============

- Richard Melo [Twitter](https://twitter.com/allucardster), [Linkedin](https://www.linkedin.com/in/richardmelo)



