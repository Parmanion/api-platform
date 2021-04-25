# API

The API will be here.

Refer to the [Getting Started Guide](https://api-platform.com/docs/distribution) for more information.

## Perso
```shell
docker-compose exec php \
    vendor/bin/schema generate src/ config/schema.yaml
```
```shell
sudo chown -R pierre:pierre api/src/ && sudo chmod -R 774 api/src/ && ls -lh api/src/Entity
```
```shell
docker-compose exec php bin/console doctrine:database:drop --force; \
docker-compose exec php bin/console doctrine:database:create; \
docker-compose exec php bin/console doctrine:schema:create; \
docker-compose exec php bin/console doctrine:migrations:migrate
```
```shell
docker-compose exec php bin/console doc:sch:up -f
```
