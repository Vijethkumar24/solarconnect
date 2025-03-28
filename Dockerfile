FROM php:apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
COPY . /var/www/html/
EXPOSE 80
CMD ["apache2-foreground"]

