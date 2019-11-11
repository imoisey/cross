FROM php:5.4-cli

RUN apt-get update && apt-get install -y \
    git \
    zip \
    zlib1g-dev \
    libxslt-dev \
    && pecl install xdebug-2.2.4 \
    && docker-php-ext-install zip \
    && docker-php-ext-install xsl \
    && docker-php-ext-install mbstring \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-enable xsl \
    && php -r "copy('https://getcomposer.org/download/1.9.0/composer.phar', 'composer.phar');" \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer

RUN useradd -m composer

WORKDIR /app

