FROM php:8.1-fpm

# Update package lists (optional, but recommended)
RUN apt-get update && apt-get clean -y

# Install Nginx and remove default configuration
RUN apt-get install -y nginx && rm -rf /etc/nginx/conf.d/default.conf && rm -rf /var/lib/apt/lists/* /var/cache/apt/archives/*

# Copy your custom Nginx configuration (optional)
COPY ./public/nginx/default.conf /etc/nginx/conf.d/

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy your application files
COPY . .

# Install dependencies for PostgreSQL client library
RUN apt-get install -y libpq-dev && rm -rf /var/lib/apt/lists/* /var/cache/apt/archives/*

# Install PHP extensions (automated)
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql pgsql

# Expose port and start services
EXPOSE 80
CMD ["service", "nginx", "start"]