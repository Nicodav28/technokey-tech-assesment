FROM php:8.1-fpm-alpine

RUN apk --no-cache add \
    nginx \
    supervisor \
    postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY ./docker/nginx.conf /etc/nginx/nginx.conf

COPY ./docker/php.ini /usr/local/etc/php/php.ini

COPY ./docker/supervisord.conf /etc/supervisord.conf

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
