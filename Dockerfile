FROM php:8.2-apache

WORKDIR /var/www/html

COPY ./app /var/www/html

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    libjpeg62-turbo-dev \
    libpng-dev \
    libfreetype6-dev \
    libwebp-dev \ 
    && docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp \ 
    && docker-php-ext-install gd

RUN service apache2 restart

EXPOSE 80
