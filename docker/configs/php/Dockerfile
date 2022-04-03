FROM php:7.4-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    autoconf \
    build-essential \
    apt-utils \
    zlib1g-dev \
    libzip-dev \
    unzip \
    zip \
    libmagick++-dev \
    libmagickwand-dev \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libjpeg-dev \
    libpng-dev

RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN docker-php-ext-install gd zip intl pdo_mysql pdo_pgsql mysqli opcache
RUN docker-php-ext-configure gd
RUN docker-php-ext-configure zip

# Tools
RUN apt-get update && apt-get install -y \
    curl \
    wget \
    git \
    iputils-ping \
    net-tools \
    nano \
    vim

# Composer
RUN DEBIAN_FRONTEND=noninteractive echo " Install COMPOSER:" \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer self-update \
    && curl -sS https://getcomposer.org/installer | php -d detect_unicode=Off

# Imagick
RUN DEBIAN_FRONTEND=noninteractive echo " Install imagick:" \
    && pecl install imagick \
    && docker-php-ext-enable imagick 

# Ghostscrip
RUN DEBIAN_FRONTEND=noninteractive echo " Install ghostscript:" \
    && wget https://github.com/luvvien/resources/raw/master/ghostscript-9.22-linux-x86_64.tar.gz \
    && tar -xzvf ghostscript-9.22-linux-x86_64.tar.gz \
    && cd ghostscript-9.22-linux-x86_64 \
    && cp gs-922-linux-x86_64 /usr/local/bin/gs \
    && cp gs-922-linux-x86_64 /usr/bin/gs \
    && rm ../ghostscript-9.22-linux-x86_64.tar.gz \
    && rm -rf ghostscript-9.22-linux-x86_64

# Clear package lists
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Permissions
RUN chown -R root:www-data /var/www/html
RUN chmod u+rwx,g+rx,o+rx /var/www/html
RUN find /var/www/html -type d -exec chmod u+rwx,g+rx,o+rx {} +
RUN find /var/www/html -type f -exec chmod u+rw,g+rw,o+r {} +

WORKDIR /var/www/html

RUN a2enmod rewrite
RUN a2enmod ssl