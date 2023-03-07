FROM debian:11.6

# 初始化环境
RUN apt update \
    && apt upgrade -y \
    && apt install -y curl wget tar bash zip unzip apt-utils gcc g++ make python2 rsync \
    && ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime

# 安装相关依赖
# - Node.js 12
RUN curl -fsSL https://deb.nodesource.com/setup_14.x | bash - \
    && apt update \
    && apt install -y nodejs

RUN npm install -g yarn@1.22.19 \
    && yarn config set proxy $HTTP_PROXY \
    && yarn config set https-proxy $HTTPS_PROXY \
    && yarn config set registry http://mirrors.cloud.tencent.com/npm/

# - PHP 7.4
RUN apt -y install lsb-release apt-transport-https ca-certificates \
    && wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
    && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list \
    && apt update \
    && bash -c "apt install -y php8.2 php8.2-{bcmath,bz2,intl,gd,mbstring,mysql,zip,xml,curl}" \
    && update-alternatives --set php /usr/bin/php8.2

# - Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer \
    && composer config -g repos.packagist composer https://mirrors.tencent.com/composer/

# - gettext
RUN apt install -y gettext

COPY ./script/build.sh /build.sh

# 配置脚本和数据
RUN chmod +x /build.sh \
    && mkdir -p /data/source \
    && mkdir -p /data/work \
    && mkdir -p /data/dist \
    && mkdir -p /data/target \
    && mkdir -p /data/cache

CMD ["/build.sh"]
