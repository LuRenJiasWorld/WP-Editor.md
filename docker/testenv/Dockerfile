FROM wp-editormd/builder:latest

# Install deps and envs
RUN apt update \
    && apt upgrade -y

# Install utilities
RUN apt install -y net-tools

# Install php-fpm
RUN apt install -y php8.2-fpm

# Install Apache
RUN apt install -y apache2 \
    && rm -rf /etc/apache2/sites-enabled/*

# Configure php-fpm for apache
RUN a2dismod php8.2 mpm_prefork mpm_event \
    && a2enmod proxy_fcgi setenvif rewrite mpm_worker \
    && a2enconf php8.2-fpm

# Copy scripts and configs
COPY script/start.sh /start.sh
COPY config/php.ini /etc/php/8.2/fpm/php.ini
COPY config/www.conf /etc/php/8.2/fpm/pool.d/www.conf
COPY config/apache2.conf /etc/apache2/apache2.conf
COPY config/mpm_worker.conf /etc/apache2/mods-enabled/
COPY config/php8.2-fpm.conf /etc/apache2/conf-enabled/

# Set scripts executable
RUN chmod +x /start.sh

CMD ["/start.sh"]

# Expose ports
# http
EXPOSE 80
# xdebug
EXPOSE 9050
