#!/bin/bash

# 重置权限
mkdir -p /home/htdocs                 \
&& mkdir -p /home/data/mysql          \
&& mkdir -p /home/data/redis          \
&& mkdir -p /home/conf/php            \
&& mkdir -p /home/conf/php-fpm        \
&& mkdir -p /home/conf/httpd          \
&& mkdir -p /home/conf/mysql          \
&& mkdir -p /home/conf/redis          \
&& mkdir -p /home/log/php-fpm         \
&& mkdir -p /home/log/httpd           \
&& mkdir -p /home/log/php             \
&& mkdir -p /home/log/redis           \
&& mkdir -p /home/log/mysql

chown -R mysql:mysql              /home/data/mysql       \
&& chown -R mysql:mysql           /home/log/mysql        \
&& chown -R mysql:mysql           /home/conf/mysql       \
&& chown -R redis:redis           /home/data/redis       \
&& chown -R redis:redis           /home/log/redis        \
&& chown -R redis:redis           /home/conf/redis       \
&& chown -R apache:apache         /home/htdocs           \
&& chown -R apache:apache         /home/log/php          \
&& chown -R apache:apache         /home/log/httpd        \
&& chown -R apache:apache         /home/log/php-fpm      \
&& chown -R apache:apache         /home/conf/httpd       \
&& chown -R apache:apache         /home/conf/php         \
&& chown -R apache:apache         /home/conf/php-fpm

# 启动PHP-FPM
php-fpm -D

# 检查MySQL目录是否为空，如果为空，初始化MySQL目录并启动MySQL
count=`ls /home/data/mysql/ | wc -w`
if [ "$count" == "0" ]; then
    mysqld --initialize-insecure --user=mysql
    sleep 5
    screen -dm mysqld --user=mysql
    sleep 5
    mysql -uroot -e "USE mysql; UPDATE user SET host = '%' WHERE user = 'root'; flush privileges;"
    sleep 1
    mysql -uroot -e "ALTER USER 'root'@'%' IDENTIFIED BY 'root';"
else
    screen -dm mysqld --user=mysql
fi

# 启动Memcached
memcached -d -c 1024 -m 128 -n 20 -f 1.25 -u nobody

# 启动Redis
redis-server /etc/redis.conf

# 启动httpd
httpd -D FOREGROUND
