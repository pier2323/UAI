FROM php:8.1-apache

WORKDIR /var/www

COPY composer.json composer.phar

RUN  composer install

COPY . .

EXPOSE 80

ENV APP_DEBUG=true
ENV APP_ENV=local

# Configuración de Apache
RUN a2enmod rewrite
RUN a2enmod headers

#COPY httpd.conf /etc/apache2/sites-available/default.conf

RUN a2dissite default
RUN a2ensite default.conf

CMD ["apache2-foreground"]

