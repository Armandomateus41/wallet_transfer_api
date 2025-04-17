FROM php:8.2-apache

# Instala extensões PDO para MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Ativa reescrita de URL
RUN a2enmod rewrite

# Define a pasta pública como raiz do Apache
WORKDIR /var/www/html
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /var/www/html

# Atualiza config do Apache para apontar pro /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf
