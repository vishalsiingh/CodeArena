FROM php:8.0-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy your app code to the web root
COPY . /var/www/html/

# (Optional) Enable Apache rewrite module
RUN a2enmod rewrite
