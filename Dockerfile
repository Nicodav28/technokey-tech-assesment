FROM php:8.0-fpm

RUN apt-get update && \
    apt-get install -y \
    nginx \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

COPY nginx/default.conf /etc/nginx/conf.d/default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80

CMD service nginx start && php-fpm
