FROM php:8.2-apache

WORKDIR /var/www/html

COPY . .

COPY .env.dev .env

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN apt-get update && \
    apt-get install -y libpng-dev libzip-dev sqlite3 libsqlite3-dev && \
    docker-php-ext-install pdo pdo_sqlite gd zip

RUN chmod -R 777 /var/www/html/storage
RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install

RUN sqlite3 exchange-rate-kazokku.db ".databases"
RUN chown www-data:www-data exchange-rate-kazokku.db

RUN php artisan migrate && \
    php artisan db:seed --class=SeederRole && \
    php artisan db:seed --class=SeederAdmin

EXPOSE 80

CMD ["apache2-foreground"]
