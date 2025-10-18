# Use official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install xml \
    && docker-php-ext-install opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock* ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy application files
COPY . .

# Create necessary directories and set permissions
RUN mkdir -p uploads/profiles email_logs \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        AllowOverride All\n\
        Require all granted\n\
        DirectoryIndex index.php index.html\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Create a simple index.html as fallback
RUN echo '<!DOCTYPE html>\n\
<html>\n\
<head>\n\
    <title>Clinic Management System</title>\n\
    <meta http-equiv="refresh" content="0; url=landing.php">\n\
</head>\n\
<body>\n\
    <p>Redirecting to <a href="landing.php">Clinic Management System</a>...</p>\n\
</body>\n\
</html>' > /var/www/html/index.html

# Configure PHP for production
RUN echo 'opcache.enable=1\n\
opcache.memory_consumption=128\n\
opcache.max_accelerated_files=4000\n\
opcache.revalidate_freq=60\n\
upload_max_filesize=10M\n\
post_max_size=10M\n\
max_execution_time=300' > /usr/local/etc/php/conf.d/production.ini

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
