FROM php:apache

# Set the ServerName to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Ensure Apache listens on port 8080 (Railway default)
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost *:80>/<VirtualHost *:8080>/' /etc/apache2/sites-enabled/000-default.conf

# Fix file permissions to avoid "Forbidden" error
RUN chown -R www-data:www-data /var/www/html/

# Allow .htaccess to override settings and allow access
RUN echo "<Directory /var/www/html/>" >> /etc/apache2/apache2.conf
RUN echo "    AllowOverride All" >> /etc/apache2/apache2.conf
RUN echo "    Order Deny,Allow" >> /etc/apache2/apache2.conf
RUN echo "    Allow from all" >> /etc/apache2/apache2.conf
RUN echo "    Require all granted" >> /etc/apache2/apache2.conf
RUN echo "</Directory>" >> /etc/apache2/apache2.conf

# Enable mod_rewrite to ensure .htaccess works correctly (if needed)
RUN a2enmod rewrite

# Set correct permissions for all files in the directory
RUN chmod -R 755 /var/www/html/

# Expose the correct port
EXPOSE 8080

# Start Apache in foreground
CMD ["apachectl", "-D", "FOREGROUND"]
