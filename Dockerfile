FROM php:8.1-fpm

RUN apt-get update && \
    apt-get install -y \
    nginx \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libicu-dev \
    libxml2-dev \
    libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    curl \
    fileinfo \
    gd \
    intl \
    mbstring \
    exif \
    mysqli \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    && rm -rf /var/lib/apt/lists/*

RUN [ -f /etc/nginx/conf.d/default.conf ] && rm /etc/nginx/conf.d/default.conf || true

COPY ./public/nginx/default.conf /etc/nginx/conf.d/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80

CMD service nginx start && php-fpm
