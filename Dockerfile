# Utilise une image PHP 8.3 avec FPM
FROM php:8.3-fpm AS app_php

# Installe l'outil pour gérer les extensions PHP
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

# Installe les extensions PHP nécessaires
RUN install-php-extensions pdo pdo_mysql mysqli

# Copie Composer depuis l'image officielle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définit le répertoire de travail
WORKDIR /var/www/html

# Copie uniquement les fichiers Composer pour tirer parti du cache Docker
COPY composer.json composer.lock* ./

# Installe les dépendances Composer (sans les dépendances de dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Copie le reste de l'application
COPY . .

# Donne les bonnes permissions
RUN chown -R www-data:www-data /var/www/html

# Expose le port PHP-FPM (9000 par défaut)
EXPOSE 9000

# Commande par défaut pour lancer PHP-FPM
CMD ["php-fpm"]
