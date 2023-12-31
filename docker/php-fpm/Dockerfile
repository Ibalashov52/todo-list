FROM php:8.2-fpm

WORKDIR "/application"

ARG DOCKER_GID=1000
ARG DOCKER_UID=1000

RUN apt-get update \
    && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libzip-dev \
        libpng-dev \
        libpq-dev \
        git \
        && docker-php-ext-install -j$(nproc) bcmath zip pdo_pgsql exif sockets \
        && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN pecl install redis xdebug \
    && docker-php-ext-enable redis.so xdebug

RUN curl https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer | php -- --quiet \
    && mv composer.phar /usr/local/bin/composer

RUN groupadd -g $DOCKER_GID dev
RUN useradd -g $DOCKER_GID -u $DOCKER_UID dev
RUN mkdir /home/dev
RUN chown -R dev:dev /home/dev

COPY ./App /application

COPY "docker/php-fpm/php-ini-overrides.ini" "/usr/local/etc/php/conf.d/99-overrides.ini"

RUN composer install

USER dev
