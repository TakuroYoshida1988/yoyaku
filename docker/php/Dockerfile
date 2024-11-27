FROM php:7.4.9-fpm

COPY php.ini /usr/local/etc/php/

# 必要なライブラリをインストールして、GD拡張を有効にする
RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && apt install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo_mysql zip gd

# Composer のインストール
RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

WORKDIR /var/www