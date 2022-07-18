FROM php:8.1-apache AS base

RUN apt-get update -y &&\
  apt-get -y install --no-install-recommends \
  default-mysql-client libxml2-dev &&\
  docker-php-ext-install pdo_mysql xml &&\
  docker-php-ext-enable xml &&\
  a2enmod allowmethods rewrite &&\
  apt-get autoremove -y &&\
  apt-get clean &&\
  rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

WORKDIR /app

RUN   mkdir /app/logs/ &&\
      touch /app/logs/app.log

# -----------------------------------------------

FROM composer:2 AS vendor

COPY composer.json /app/

RUN composer install \
  --ignore-platform-reqs \
  --no-ansi \
  --no-autoloader \
  --no-dev \
  --no-interaction \
  --no-scripts

COPY . /app

RUN composer dump-autoload --optimize --classmap-authoritative --ignore-platform-reqs

# -----------------------------------------------

FROM base AS development

ENV APACHE_SERVER_NAME "localhost"
ENV APACHE_DOCUMENT_ROOT "/app/public"

RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY docker/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY docker/apache.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /app
