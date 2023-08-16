FROM ubuntu:20.04

RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libicu-dev

# Install Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer --version=2.2.0

RUN docker-php-ext-install zip

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="1" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10" \
    PHP_OPCACHE_ENABLE="1"

RUN docker-php-ext-install opcache

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

# Install Postgres PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get update && apt-get install -y librabbitmq-dev libssh-dev \
    && docker-php-ext-install bcmath sockets \
    && pecl install amqp \
    && docker-php-ext-enable amqp

RUN apt-get update

RUN apt-get install -y \
    libfreetype6-dev \
    libmcrypt-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev

RUN curl -sL https://deb.nodesource.com/setup_20.x -o nodesource_setup.sh \
    bash nodesource_setup.sh \
    apt-get install nodejs \
    npm install \
    npm run dev \



RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

WORKDIR /app

CMD php artisan serve

EXPOSE 8181
