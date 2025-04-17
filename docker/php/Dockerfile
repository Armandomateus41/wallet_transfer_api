# Usa a imagem oficial do PHP 8.3 com Apache
FROM php:8.3-apache

# Habilita extensões do PHP necessárias (PDO MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Instala dependências para o Composer e outras libs úteis
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    zip \
    libzip-dev \
    && docker-php-ext-install zip

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite

# Define a pasta padrão do Apache para apontar para /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Copia o Composer do container oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www/html
