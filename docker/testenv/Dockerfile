FROM wp-editormd/builder:latest

# Install deps and envs
RUN apt update \
    && npm install -g pm2

# Install php-fpm
RUN apt install -y php7.4-fpm

# Install Apache
RUN apt install -y apache2 \
    && rm -rf /etc/apache2/sites-enabled/*

# Configure php-fpm for apache
RUN a2enmod proxy_fcgi setenvif \
    && a2enconf php7.4-fpm

# Copy scripts and configs
COPY script/start.sh /start.sh
COPY config/php.ini /etc/php/7.4/fpm/php.ini
COPY config/www.conf /etc/php/7.4/fpm/php-fpm.d/www.conf
COPY config/apache2.conf /etc/apache2/apache2.conf

# Set scripts executable
RUN chmod +x /start.sh

CMD ["/start.sh"]

# Expose ports
# http
EXPOSE 80
# xdebug
EXPOSE 9050
