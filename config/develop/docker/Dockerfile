FROM composer AS composer-php

FROM php:8.4-apache

COPY ../../.. .
WORKDIR /var/www/html

# copy composer
COPY --from=composer-php /usr/bin/composer /usr/bin/composer
COPY config/prod/.user.ini /usr/local/etc/php/conf.d/user.ini

# criar usuario e grupo admin
RUN useradd -m -d /home/admin -s /bin/bash admin
RUN usermod -a -G www-data admin

# installing dependencies
RUN apt-get update && apt-get install -y \
	git \
	curl \
	exif \
	libicu-dev \
	libonig-dev \
	libzip-dev \
	libz-dev \
	zip \
	unzip \
	libpq-dev \
	libxml2-dev \
	libbz2-dev \
	zlib1g-dev \
	libpng-dev \
	libjpeg-dev \
	libmcrypt-dev \
	libreadline-dev \
	libfreetype6-dev \
	g++ \
	nano \
	cron \
	tzdata \
    wget \
    wkhtmltopdf

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install \
	bz2 \
	intl \
	bcmath \
	opcache \
	calendar \
	pdo \
	pdo_pgsql \
	pgsql \
	xml \
	zip \
	mbstring \
	gd

RUN ln -snf /usr/share/zoneinfo/America/Recife /etc/localtime \
	&& echo "America/Recife" > /etc/timezone \
	&& dpkg-reconfigure -f noninteractive tzdata

RUN echo "date.timezone = America/Recife" >> /usr/local/etc/php/php.ini

RUN chown -R root:www-data /var/www && chmod -R 775 /var/www

# modifying apache
RUN a2enmod rewrite
RUN addgroup --gid 1000 appuser; \
    adduser --uid 1000 --gid 1000 --disabled-password appuser; \
    adduser www-data appuser; \
    sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf; \
    sed -i 's|/var/www/html|/var/www/html/public|' /etc/apache2/sites-available/000-default.conf; \
    chown -R www-data:www-data /var/www/html/public; \
    service apache2 restart;

# installing and setting xdbug
RUN pecl install xdebug \
    && echo "[XDEBUG]" > /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "zend_extension=\"xdebug.so\"" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_host = 127.0.0.1" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_port = 9003" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.start_with_request=trigger" >> /usr/local/etc/php/conf.d/xdebug.ini

# installing dockerize
ENV DOCKERIZE_VERSION=v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

# Mudar para o usuário "root"
USER root

RUN rm -f /var/run/apache2/apache2.pid