# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy your code to Apache's web root
COPY ./public /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Give Apache access rights (optional but safe)
RUN chown -R www-data:www-data /var/www/html

# Optional: expose the default port
EXPOSE 80
