FROM php:8.0-apache as tubes-1

# Install git and mysql for php

RUN apt-get update && apt-get install -y git
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite

WORKDIR /var
# Copy ke /var/scripts
COPY ./scripts/db/base.sql ./scripts/db/base.sql
EXPOSE 80/tcp
EXPOSE 443/tcp