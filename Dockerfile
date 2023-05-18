FROM php:8.1 as php

RUN apt-get update -y
RUN docker-php-ext-install pdo pdo_mysql bcmath
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis
RUN echo "extension=redis.so" >> /usr/local/etc/php/php.ini

WORKDIR /var/www
COPY . .

COPY --from=composer:2.3.5 /usr/bin/composer/ /usr/bin/composer/
ENV PORT=8000
ENTRYPOINT ["docker/entrypoint.sh"]