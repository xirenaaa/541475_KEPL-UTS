# backend/Dockerfile
# Uses FrankenPHP as application server (Soal 7 bonus)
FROM dunglas/frankenphp:1.4-php8.4-bookworm AS base

# Install PHP extensions required by Laravel
RUN install-php-extensions \
    pdo_mysql \
    mbstring \
    bcmath \
    opcache \
    pcntl \
    zip

# Install Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files first for Docker layer caching (Soal 5a)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy application code
COPY . .

# Generate optimized autoload and finish composer install
RUN composer dump-autoload --optimize && \
    composer run-script post-autoload-dump || true

# Set permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache && \
    chmod -R 775 /app/storage /app/bootstrap/cache

# Create symlink to frankenphp binary for Octane
RUN ln -sf /usr/local/bin/frankenphp /app/frankenphp || true

# Create SQLite database directory (fallback, normally uses MySQL in Docker Compose)
RUN mkdir -p /app/database && touch /app/database/database.sqlite

# No secrets in Dockerfile (Soal 5d)
# APP_KEY, DB_PASSWORD etc. are injected via environment variables at runtime

EXPOSE 8000

# Run with FrankenPHP (Soal 7)
CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8000"]
