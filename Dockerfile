FROM php:8.1-fpm

# Update package lists and install dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/archives/*

# Install libpq-dev with retry logic
RUN apt-get update && apt-get install -y libpq-dev \
    || (echo "Failed to install libpq-dev. Retrying..." && sleep 1 \
    && apt-get install -y libpq-dev) \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/archives/*

# Verify libpq-dev installation
RUN if [ ! -f /usr/include/postgresql/postgres_ext.h ]; then \
    echo "ERROR: libpq-dev not installed correctly."; \
    exit 1; \
    fi

# Remove default Nginx configuration if it exists
RUN [ -f /etc/nginx/conf.d/default.conf ] && rm -rf /etc/nginx/conf.d/default.conf || echo "Default Nginx config not found, skipping removal"

# Copy your custom Nginx configuration (optional)
COPY ./public/nginx/default.conf /etc/nginx/conf.d/

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy your application files
COPY . .

# Install PHP extensions (automated)
RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Expose port and start services
EXPOSE 80
CMD ["service", "nginx", "start"]
