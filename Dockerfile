FROM php:8.1-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN docker-php-ext-install pdo pdo_mysql sockets gd bcmath
RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .
RUN composer install
