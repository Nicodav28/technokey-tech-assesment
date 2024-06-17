FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    nginx \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/archives/*

RUN apt-get update && apt-get install -y libpq-dev \
    || (echo "Failed to install libpq-dev. Retrying..." && sleep 1 \
    && apt-get install -y libpq-dev) \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/archives/*

RUN if [ ! -f /usr/include/postgresql/postgres_ext.h ]; then \
    echo "ERROR: libpq-dev not installed correctly."; \
    exit 1; \
    fi

RUN [ -f /etc/nginx/conf.d/default.conf ] && rm -rf /etc/nginx/conf.d/default.conf || echo "Default Nginx config not found, skipping removal"

COPY ./public/nginx/default.conf /etc/nginx/conf.d/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

EXPOSE 80
