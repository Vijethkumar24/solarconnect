FROM php:apache

# Set the ServerName to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Allow Apache to listen on any assigned port dynamically
RUN echo "Listen 8080" > /etc/apache2/ports.conf

# Ensure Apache uses the Railway-assigned PORT
RUN sed -i "s/VirtualHost \*:80/VirtualHost *:${PORT}/g" /etc/apache2/sites-available/000-default.conf

# Expose Railway's dynamic port (8080)
EXPOSE 8080

# Start Apache
CMD ["apachectl", "-D", "FOREGROUND"]
