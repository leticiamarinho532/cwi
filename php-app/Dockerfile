FROM php:8.4-fpm

ARG UID=1000
ARG GID=1000

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git unzip zlib1g-dev libzip-dev libxml2-dev libonig-dev \
    sqlite3 libsqlite3-dev \
    openssl \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring bcmath zip mysqli \
    && docker-php-ext-enable pdo_mysql pdo_sqlite

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

RUN groupmod -g $GID www-data \
    && usermod -u $UID -g $GID www-data

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN mkdir -p storage bootstrap/cache database \
    && touch database/database.sqlite \
    && chown -R www-data:www-data storage bootstrap/cache database

USER www-data