# Dockerfile/apache/Dockerfile
FROM php:7.4-apache

# Enable Apache modules
RUN a2enmod proxy proxy_http

# Copy the custom Apache configuration file
COPY conf/apache.conf /etc/apache2/sites-available/000-default.conf

# Enable the new configuration
RUN a2ensite 000-default.conf
