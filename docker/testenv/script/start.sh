#!/usr/bin/env bash

# Set permission
mkdir -p /home/htdocs /run/php
chown -R www-data:www-data /home/htdocs

# Start php-fpm
pm2 start /usr/sbin/php-fpm7.4 --name="php-fpm7.4" -- -F

# Start apache
source /etc/apache2/envvars
while true
do
  /usr/sbin/apache2 -D FOREGROUND
done
