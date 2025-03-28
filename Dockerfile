FROM php:apache

# Set the ServerName to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Allow Apache to listen on any assigned port
RUN sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf

# Expose the correct port (Railway dynamically assigns it)
EXPOSE 8080

# Keep Apache running in the foreground
CMD ["apachectl", "-D", "FOREGROUND"]
