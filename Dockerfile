#FROM node:latest AS node
FROM php:8.0-fpm-alpine

#COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
#COPY --from=node /usr/local/bin/node /usr/local/bin/node
#RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# lumen packages
RUN docker-php-ext-install tokenizer mysqli pdo_mysql
# memcached
RUN apk update && apk add g++ make git wget bzip2-dev zlib-dev libpng-dev tzdata fcgi cyrus-sasl-dev libmemcached-libs
RUN apk update && apk add nodejs npm

# Install Memcache and redis
 ENV MEMCACHE_DEPS zlib-dev cyrus-sasl-dev php7-dev g++ make git
 RUN apk add --no-cache -t .phpize-deps $PHPIZE_DEPS && \
     apk add --no-cache -t .memcache-deps $MEMCACHE_DEPS && \
     ## Prepare php for extensions
     apk add --no-cache -u \
     # Install timezone util
     tzdata \
     ## fpm healthcheck status check dep
     fcgi \
     zlib-dev \
     && \
     # Install memcache
     cd /tmp && git clone https://github.com/websupport-sk/pecl-memcache && \
     cd pecl-memcache && \
     phpize && \
     ./configure && \
     make && \
     make install && \
     docker-php-ext-enable memcache && \
     ## PHP extensions
     docker-php-ext-install -j$(nproc) bcmath && \
     # Install pcntl
     docker-php-ext-install pcntl && \
     apk del .phpize-deps && \
     apk del .memcache-deps

RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer


RUN echo www-data:pass | chpasswd

COPY --chown=www-data:www-data . /var/www
WORKDIR /var/www


RUN composer update && composer install --prefer-source --no-interaction
RUN npm install

ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"
# Install Memcache and redis

USER www-data

EXPOSE 9000
CMD ["php-fpm"]
