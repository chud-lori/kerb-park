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
WORKDIR /var/www/kerb
RUN composer install
RUN php artisan schedule:work
# Add crontab file in the cron directory
# ADD schedule/crontab /etc/cron.d/cron
# RUN chmod 0644 /etc/cron.d/cron
# RUN touch /var/log/cron.log
# CMD printenv > /etc/environment && echo “cron starting…” && (cron) && : > /var/log/cron.log && tail -f /var/log/cron.log

