ARG php_version=8.1

FROM php:${php_version}

RUN pecl install pcov && \
  docker-php-ext-enable pcov \
