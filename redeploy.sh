#!/bin/sh

docker-compose stop
docker-compose rm -f
docker-compose up -d

docker exec -i test_task_4.php_fpm_1 sh -c "composer install"
