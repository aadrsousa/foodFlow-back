FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
        libicu-dev \
        && docker-php-ext-install -j$(nproc) intl \
        && docker-php-ext-install pdo pdo_mysql \
        && docker-php-ext-install mysqli

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/writable/
RUN chmod -R 775 /var/www/html/writable/
RUN a2enmod rewrite
RUN sed -i -e 's,/var/www/html,/var/www/html/public,g' /etc/apache2/sites-available/000-default.conf

