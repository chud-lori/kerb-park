# Dockerfile
FROM php:7.4.1-apache

RUN apt update \
    && apt install -y \
    g++ \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    zip \
    zlib1g-dev \
    cron \
    && docker-php-ext-install \
    intl \
    opcache \
    pdo \
    pdo_pgsql \
    pgsql 
RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer​ | php -- \
    --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ADD . /var/www
ADD ./public /var/www/html
WORKDIR /var/www
RUN composer update
RUN composer install
RUN php artisan key:generate
RUN php artisan migrate
RUN php artisan db:seed

# Add crontab file in the# Crontab file copied to cron.d directory.
COPY cronjob /etc/cron.d/container_cronjob

# Script file copied into container.
COPY script.sh /script.sh

# Giving executable permission to script file.
RUN chmod +x /script.sh

# Running commands for the startup of a container.
CMD ["/bin/bash", "-c", "/script.sh && chmod 644 /etc/cron.d/container_cronjob && cron && tail -f /var/log/cron.log"]