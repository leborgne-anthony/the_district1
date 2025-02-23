FROM php:8.2-apache

WORKDIR /var/www/html

COPY ./app /var/www/html

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

RUN service apache2 restart

EXPOSE 80
