Проект содержит полностью готовый для запуска докер контейнер.

Для запуска
```shell script
cd devops
````

```shell script
docker-compose -p planes up -d
````

Для остановки
```shell script
docker-compose -p planes down
````

После запуска нужно зайти в контейнер
```shell script
docker exec -it planes_php_1 bash
```

Все запросы проводятся по адресу  **http://127.0.0.1/**

RestApi:

```
GET http://127.0.0.1/api/v1/hangars/{hangar}/planes
```

Для запуска вне контейнера можно использовать встроенный в Symfony web сервер
```
symfony server:start
```
После чего приложение доступно по **http://127.0.0.1:8000**
