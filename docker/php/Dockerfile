FROM php:8.0-fpm-alpine
# lumen packages
RUN docker-php-ext-install tokenizer mysqli pdo_mysql
# memcached
ENV MEMCACHED_DEPS zlib-dev libmemcached-dev cyrus-sasl-dev
RUN apk add --no-cache --update libmemcached-libs zlib
RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer
COPY . /var/www
WORKDIR /var/www
RUN composer install --prefer-source --no-interaction
ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"
