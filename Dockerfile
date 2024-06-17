FROM php:8.1-fpm

RUN apt-get update && \
    apt-get install -y \
    nginx \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && rm -rf /var/lib/apt/lists/*

RUN [ -f /etc/nginx/conf.d/default.conf ] && rm /etc/nginx/conf.d/default.conf || true

COPY ./public/nginx/default.conf /etc/nginx/conf.d/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80

CMD service nginx start && php-fpm
