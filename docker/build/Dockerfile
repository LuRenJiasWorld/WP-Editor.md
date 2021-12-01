FROM debian:11.1

# 初始化环境
RUN apt update \
    && apt upgrade \
    && apt install -y curl wget tar bash zip unzip apt-utils

# 安装相关依赖
# - Node.js 14
RUN curl -fsSL https://deb.nodesource.com/setup_14.x | bash - \
    && apt update \
    && apt install -y nodejs \
    && npm config set proxy $HTTP_PROXY \
    && npm config set https-proxy $HTTPS_PROXY \
    && npm install -g npm \
    && npm install -g @vue/cli \
    && npm install -g webpack \
    && npm install -g webpack-cli \
    && npm install -g webpack-dev-server \
    && npm install -g node-sass

# - PHP 7.4
RUN apt -y install lsb-release apt-transport-https ca-certificates \
    && wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
    && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list \
    && apt update \
    && bash -c "apt install -y php7.4 php7.4-{bcmath,bz2,intl,gd,mbstring,mysql,zip,xml,curl}" \
    && update-alternatives --set php /usr/bin/php7.4

# - Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# - gettext
RUN apt -y install gettext

COPY ./script/build.sh /build.sh

# 配置脚本和数据
RUN chmod +x /build.sh \
    && mkdir -p /data/source \
    && mkdir -p /data/work \
    && mkdir -p /data/target

CMD ["/build.sh"]
