
FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    curl ca-certificates git unzip zip \
    libzip-dev libicu-dev libpng-dev \
    libonig-dev libsqlite3-dev \
    && docker-php-ext-install pdo_mysql pdo_sqlite bcmath gd intl zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
    && sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

COPY . .

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader \
    && chown -R www-data:www-data storage bootstrap/cache

RUN printf '#!/bin/sh\nset -e\nphp artisan migrate --force\nexec apache2-foreground\n' > /start.sh \
    && chmod +x /start.sh

CMD ["/start.sh"]
