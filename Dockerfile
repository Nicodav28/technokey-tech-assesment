FROM php:8.1-fpm

RUN apt-get update && \
    apt-get install -y \
    nginx \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

RUN [ -f /etc/nginx/conf.d/default.conf ] && rm /etc/nginx/conf.d/default.conf || true

COPY ./public/nginx/default.conf /etc/nginx/conf.d/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

RUN set -eux; \
    { \
    echo 'extension=curl'; \
    echo 'extension=fileinfo'; \
    echo 'extension=gd'; \
    echo 'extension=intl'; \
    echo 'extension=mbstring'; \
    echo 'extension=exif'; \
    echo 'extension=mysqli'; \
    echo 'extension=openssl'; \
    echo 'extension=pdo_mysql'; \
    echo 'extension=pdo_pgsql'; \
    echo 'extension=pgsql'; \
    } > /usr/local/etc/php/conf.d/docker-php-ext-custom.ini

COPY . .

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80

CMD service nginx start && php-fpm
