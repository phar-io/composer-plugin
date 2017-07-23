FROM php:5.6-alpine
MAINTAINER Tommy Muehle <tommy.muehle@gmail.com>

RUN apk add --no-cache --virtual .build-deps autoconf gcc make g++ zlib-dev file libc-dev pkgconf \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/* /var/tmp/* /tmp/*

RUN apk update --no-cache \
    && apk add --no-cache gnupg \
    && rm -rf /var/cache/apk/* /var/tmp/* /tmp/*

RUN echo "date.timezone=Europe/Berlin" > $PHP_INI_DIR/conf.d/date.ini

VOLUME ["/app"]
WORKDIR /app