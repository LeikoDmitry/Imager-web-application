FROM php:7.4-cli

## Update package information
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libxml2-dev \
        libxslt1-dev \
        libpng-dev \
        libpq-dev \
        libonig-dev \
        libicu-dev \
        libzip-dev \
        librabbitmq-dev libssl-dev \
        libmagickwand-dev librabbitmq-dev

## Install zip libraries and extension
RUN apt-get install --yes git zlib1g-dev libzip-dev \
    && docker-php-ext-install zip

## Install intl library and extension
RUN apt-get install --yes libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg

## mbstring for i18n string support
RUN docker-php-ext-install mbstring

RUN pecl install amqp \
     && docker-php-ext-enable amqp

ARG USER_ID=0
RUN groupadd -r appuser
RUN useradd -r -u ${USER_ID} -g appuser appuser
WORKDIR /var/www