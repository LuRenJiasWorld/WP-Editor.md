#!/usr/bin/env bash

# Set permission
mkdir -p /home/htdocs /run/php
chown -R www-data:www-data /home/htdocs

# Start php-fpm
/usr/sbin/php-fpm8.2 -R -y /etc/php/8.2/fpm/php-fpm.conf

# Start apache
source /etc/apache2/envvars
while true
do
  /usr/sbin/apache2 -D FOREGROUND
done
