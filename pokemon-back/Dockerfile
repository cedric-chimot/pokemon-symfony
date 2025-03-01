# Utiliser l'image officielle PHP avec Apache
FROM php:8.2-apache

# Installer les dépendances nécessaires pour Symfony
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    git \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql mysqli

# Activer le module Apache rewrite
RUN a2enmod rewrite

# Copier le code source de Symfony dans le conteneur
COPY ./pokemon-back /var/www/html

# Installer les dépendances PHP de Symfony via Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/html
RUN composer install

# Exposer le port 80
EXPOSE 80
