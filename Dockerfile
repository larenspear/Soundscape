# Use the official PHP image with Apache
FROM php:8.1-apache

# Enable Apache mod_rewrite for URL rewriting
RUN a2enmod rewrite
RUN docker-php-ext-install mysqli
# Set the working directory
WORKDIR /var/www/html

# Copy application files to the container
COPY . /var/www/html/

# Set appropriate permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
