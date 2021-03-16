FROM php:7.4-apache

## Update package information
RUN apt-get update && apt-get install -y nano \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libxml2-dev \
        libxslt1-dev \
        libpng-dev \
        libpq-dev \
        libonig-dev \
        libicu-dev \
        libzip-dev \
        librabbitmq-dev \
        libssl-dev \
        libmagickwand-dev

## Configure Apache
RUN a2enmod rewrite \
    && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
    && mv /var/www/html /var/www/public

## Install Composer
RUN curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

###
## PHP Extensisons
###

## Install zip libraries and extension
RUN apt-get install --yes git zlib1g-dev libzip-dev \
    && docker-php-ext-install zip

## Install intl library and extension
RUN apt-get install --yes libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg

###
## Optional PHP extensions
###

## mbstring for i18n string support
RUN docker-php-ext-install mbstring

## MySQL PDO support
RUN docker-php-ext-install pdo_mysql

## PostgreSQL PDO support
RUN apt-get install --yes libpq-dev \
     && docker-php-ext-install pdo_pgsql

## APCU
RUN pecl install apcu \
     && docker-php-ext-enable apcu

## Memcached
# RUN apt-get install --yes libmemcached-dev \
#     && pecl install memcached \
#     && docker-php-ext-enable memcached


## redis pecl options
RUN pecl install igbinary xdebug imagick amqp \
     && docker-php-ext-enable igbinary xdebug imagick amqp \
     && apt-get install --yes libzstd-dev \
     && pecl install redis \
     && docker-php-ext-enable redis

ARG USER_ID=0
RUN groupadd -r appuser
RUN useradd -r -u ${USER_ID} -g appuser appuser
RUN sed -i 's!<policy domain="coder" rights="none" pattern="PDF" />!<policy domain="coder" rights="read|write" pattern="PDF" />!g' /etc/ImageMagick-6/policy.xml
WORKDIR /var/www