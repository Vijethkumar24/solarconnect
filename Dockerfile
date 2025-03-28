FROM php:apache

# Set the ServerName to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Expose the correct port (Railway uses 8080)
EXPOSE 8080

# Keep Apache running in the foreground
CMD ["apachectl", "-D", "FOREGROUND"]
