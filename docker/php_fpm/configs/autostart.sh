#!/bin/bash

service php7.1-fpm start
service gearman-job-server start
service supervisor start
