FROM php:7.4-apache

# Instalar dependências e extensões necessárias
RUN apt-get update && \
    apt-get install -y libicu-dev && \
    docker-php-ext-install intl mysqli pdo pdo_mysql && \
    docker-php-ext-enable mysqli

# Ativar mod_rewrite do Apache
RUN a2enmod rewrite

# Configurar o DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Copiar configuração PHP personalizada (opcional)
COPY docker/php.ini /usr/local/etc/php/

WORKDIR /var/www/html

# Ajustar permissões da pasta writable
RUN chown -R www-data:www-data /var/www/html/writable && chmod -R 775 /var/www/html/writable

