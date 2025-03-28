FROM php:apache

# Set the ServerName to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Ensure Apache listens on the correct port (Railway uses 8080)
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost *:80>/<VirtualHost *:8080>/' /etc/apache2/sites-enabled/000-default.conf

# Expose the correct port
EXPOSE 8080

# Start Apache in foreground
CMD ["apachectl", "-D", "FOREGROUND"]
