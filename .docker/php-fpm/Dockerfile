FROM php:7.4-fpm-alpine

ARG TIMEZONE

RUN apk update && apk add imap-dev openssl-dev; \
    docker-php-ext-configure imap --with-imap --with-imap-ssl && \
    echo date.timezone=$TIMEZONE > /usr/local/etc/php/conf.d/date.timezone.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer
