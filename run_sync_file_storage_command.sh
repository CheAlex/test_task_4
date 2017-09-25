#!/bin/sh

docker exec -i test_task_4.php_fpm_1 php bin/console che-alex-image-storage:sync-file-storage
