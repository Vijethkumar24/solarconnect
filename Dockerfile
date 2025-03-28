FROM php:apache

# Set the ServerName to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Ensure Apache listens on port 8080 (Railway default)
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost *:80>/<VirtualHost *:8080>/' /etc/apache2/sites-enabled/000-default.conf

# Copy application files with correct ownership
COPY --chown=www-data:www-data . /var/www/html/

# Fix file permissions to avoid "Forbidden" error
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/

# Configure Apache directory settings
RUN echo "<Directory /var/www/html/>" >> /etc/apache2/apache2.conf \
    && echo "    Options Indexes FollowSymLinks" >> /etc/apache2/apache2.conf \
    && echo "    AllowOverride All" >> /etc/apache2/apache2.conf \
    && echo "    Require all granted" >> /etc/apache2/apache2.conf \
    && echo "</Directory>" >> /etc/apache2/apache2.conf

# Enable necessary Apache modules
RUN a2enmod rewrite headers

# Expose the correct port
EXPOSE 8080

# Start Apache in foreground
CMD ["apache2-foreground"]