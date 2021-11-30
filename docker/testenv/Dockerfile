FROM centos:7.7.1908

# 默认开启端口：
# - PHP-FPM:   9000
# - xdebug:    9050
# - Apache:    80
# - MySQL:     3306
# (根据自己的需求随意映射)

# 文件存放目录
# - 网站根目录              /home/htdocs
#
# - MySQL根目录            /home/data/mysql
# - Redis根目录            /home/data/redis
#
# - php.ini配置文件        /home/conf/php
# - PHP-FPM配置文件        /home/conf/php-fpm
# - Apache配置文件         /home/conf/httpd
# - MySQL配置文件          /home/conf/mysql
# - Redis配置文件          /home/conf/redis
#
# - PHP-FPM日志           /home/log/php-fpm
# - Apache日志            /home/log/httpd
# - PHP日志               /home/log/php
# - MySQL日志             /home/log/mysql
# - Redis日志             /home/log/redis

# 安装基础软件
RUN yum update -y                                                               \
    && yum install -y epel-release                                              \
    && yum clean all                                                            \
    && yum makecache                                                            \
    && yum groupinstall -y 'Development Tools'                                  \
    && yum install -y yum-utils net-tools sendmail git bc svn zip unzip screen vim zsh wget traceroute telnet setuptool nmon iotop bzip2 gzip psmisc xfsprogs tcpdump lvm2 sysstat htop openssl \
    && yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm    \
    && yum makecache                                                            \
    && yum install -y ImageMagick ImageMagick-devel ImageMagick-perl            \ 
    && yum --enablerepo=remi install -y redis memcached                         \
    && echo -e "set ts=4\nset expandtab" > /root/.vimrc

# 安装PHP
RUN yum install -y php74-runtime.x86_64            \
    php74.x86_64                                   \
    php74-build.x86_64                             \
    php74-php.x86_64                               \
    php74-php-bcmath.x86_64                        \
    php74-php-cli.x86_64                           \
    php74-php-common.x86_64                        \
    php74-php-dba.x86_64                           \
    php74-php-devel.x86_64                         \
    php74-php-fpm.x86_64                           \
    php74-php-gd.x86_64                            \
    php74-php-gmp.x86_64                           \
    php74-php-imap.x86_64                          \
    php74-php-intl.x86_64                          \
    php74-php-json.x86_64                          \
    php74-php-ldap.x86_64                          \
    php74-php-lz4.x86_64                           \
    php74-php-mbstring.x86_64                      \
    php74-php-mysqlnd.x86_64                       \
    php74-php-odbc.x86_64                          \
    php74-php-pdo.x86_64                           \
    php74-php-pdo-dblib.x86_64                     \
    php74-php-pear.noarch                          \
    php74-php-pecl-crypto.x86_64                   \
    php74-php-pecl-geoip.x86_64                    \
    php74-php-pecl-env.x86_64                      \
    php74-php-pecl-gnupg.x86_64                    \
    php74-php-pecl-http.x86_64                     \
    php74-php-pecl-imagick.x86_64                  \
    php74-php-pecl-inotify.x86_64                  \
    php74-php-pecl-leveldb.x86_64                  \
    php74-php-pecl-lua.x86_64                      \
    php74-php-pecl-mcrypt.x86_64                   \
    php74-php-pecl-json-post.x86_64                \
    php74-php-pecl-memcached.x86_64                \
    php74-php-pecl-mysql-xdevapi.x86_64            \
    php74-php-pecl-mysql.x86_64                    \
    php74-php-pecl-rar.x86_64                      \
    php74-php-pecl-redis5.x86_64                   \
    php74-php-pecl-swoole4.x86_64                  \
    php74-php-pecl-uuid.x86_64                     \
    php74-php-pecl-xdebug.x86_64                   \
    php74-php-pecl-xlswriter.x86_64                \
    php74-php-pecl-yaml.x86_64                     \
    php74-php-pgsql.x86_64                         \
    php74-php-pecl-zip.x86_64                      \    
    php74-php-snmp.x86_64                          \
    php74-php-soap.x86_64                          \
    php74-php-sodium.x86_64                        \
    php74-php-xml.x86_64                           \
    php74-php-xmlrpc.x86_64 

# 安装Composer
RUN cd /opt/remi/php74/root/usr/bin/                                                       \
    && ./php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"         \
    && ./php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && ./php composer-setup.php --filename=composer                                        \
    && ./php -r "unlink('composer-setup.php');"                                            \
    && cd /root/ 

# 链接PHP相关二进制文件
RUN ln -s /opt/remi/php74/root/usr/bin/*         /usr/bin   \
    && ln -s /opt/remi/php74/root/usr/sbin/*     /usr/bin

# 安装MySQL
RUN rpm -ivh https://dev.mysql.com/get/mysql80-community-release-el7-1.noarch.rpm \
    && yum makecache                                                              \
    && yum install -y mysql-community-server

# 安装Apache
RUN yum install -y httpd                        \
    && rm -rf /etc/httpd/conf.d/welcome.conf

# 拷贝配置文件
# 1. PHP-FPM进程池配置
COPY conf/www.conf              /etc/opt/remi/php74/php-fpm.d/
# 2. php.ini配置
COPY conf/php.ini               /etc/opt/remi/php74/php.ini
# 3. my.cnf配置
COPY conf/my.cnf                /etc/
# 4. httpd.conf配置
COPY conf/httpd.conf            /etc/httpd/conf/
# 5. Redis配置
COPY conf/redis.conf            /etc/

# 新建/链接/拷贝目录
RUN mkdir -p /home/htdocs                   \
    && mkdir -p /home/data/mysql            \
    && mkdir -p /home/data/redis            \
    && mkdir -p /home/conf/php              \
    && mkdir -p /home/conf/php-fpm          \
    && mkdir -p /home/conf/httpd            \
    && mkdir -p /home/conf/mysql            \
    && mkdir -p /home/conf/redis            \
    && mkdir -p /home/log/php-fpm           \
    && mkdir -p /home/log/httpd             \
    && mkdir -p /home/log/php               \
    && mkdir -p /home/log/redis             \
    && mkdir -p /home/log/mysql             \
    && ln -s /etc/my.cnf                                /home/conf/mysql        \
    && ln -s /etc/redis.conf                            /home/conf/redis        \
    && ln -s /etc/opt/remi/php74/php-fpm.conf           /home/conf/php-fpm && ln -s /etc/opt/remi/php74/php-fpm.d /home/conf/php-fpm \
    && ln -s /etc/opt/remi/php74/php.ini                /home/conf/php          \
    && ln -s /var/log/httpd/*                           /home/conf/httpd        \
    && ln -s /var/log/redis/*                           /home/log/redis         \
    && ln -s /etc/httpd/*                               /home/log/httpd         \
    && ln -s /var/opt/remi/php74/log/*                  /home/log/php-fpm       \
    && ln -s /var/log/mysqld.log                        /home/log/mysql

# 配置各个目录的权限（在启动的时候需要重新配置一遍，以防万一）
RUN chown -R mysql:mysql                /home/data/mysql        \
    && chown -R mysql:mysql             /home/log/mysql         \
    && chown -R mysql:mysql             /home/conf/mysql        \
    && chown -R redis:redis             /home/data/redis        \
    && chown -R redis:redis             /home/log/redis         \
    && chown -R redis:redis             /home/conf/redis        \
    && chown -R apache:apache           /home/htdocs            \
    && chown -R apache:apache           /home/log/php           \
    && chown -R apache:apache           /home/log/httpd         \
    && chown -R apache:apache           /home/log/php-fpm       \
    && chown -R apache:apache           /home/conf/httpd        \
    && chown -R apache:apache           /home/conf/php          \
    && chown -R apache:apache           /home/conf/php-fpm

# 拷贝启动脚本
COPY script/init.sh            /

# 给予init.sh可执行权限
RUN chmod +x /init.sh

# 配置启动脚本
CMD /init.sh

# httpd
EXPOSE 80
# MySQL
EXPOSE 3306
# PHP-FPM
EXPOSE 9000
# xdebug
EXPOSE 9050
