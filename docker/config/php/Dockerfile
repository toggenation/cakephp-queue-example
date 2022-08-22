FROM php:fpm

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \ 
    libzip-dev \
    zip \
    vim \
    git \
    wget \
    yui-compressor \
    poppler-utils libtidy-dev \
    icu-devtools libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd 

RUN docker-php-ext-install intl pdo pdo_mysql

RUN cd /usr/local/etc/php/conf.d/ && \
    echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-ram-limit.ini

ARG VERSION=v18.7.0

RUN mkdir /build && apArch=$(arch); \
    case "$apArch" in \
    x86_64) export DISTRO='linux-x64' ;; \
    aarch64) export DISTRO='linux-arm64' ;;\
    esac;\ 
    cd /build && \
    wget https://nodejs.org/dist/${VERSION}/node-${VERSION}-${DISTRO}.tar.xz && \
    tar -xvf node-${VERSION}-${DISTRO}.tar.xz --strip-components=1 -C /usr/local

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install tidy && docker-php-ext-enable tidy

RUN docker-php-ext-install exif

RUN docker-php-ext-install zip

WORKDIR /

COPY composerInstall.sh .

RUN chmod +x composerInstall.sh && ./composerInstall.sh && rm -f composerInstall.sh

RUN apt-get install -y procps

RUN apt-get clean && apt-get autoremove -y && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/src

RUN addgroup --gid 1073 phpdev

RUN adduser --disabled-password --gecos "" --force-badname --ingroup phpdev phpdev

RUN usermod -G 1073 www-data

RUN echo umask 0002 >> /home/phpdev/.profile

WORKDIR /var/www/html

USER phpdev
