FROM php:8.1-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www
RUN apt-get update
RUN apt-get -y install curl gnupg
#RUN curl -sL https://deb.nodesource.com/setup_16.x  | bash -


# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    nodejs \
    curl \
    libonig-dev \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install additional PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd
RUN   pecl install xdebug && \
      docker-php-ext-enable xdebug

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
# env development
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
# env production

RUN echo "memory_limit=1024M" >> /usr/local/etc/php/conf.d/php.ini
RUN echo "allow_url_fopen=on" >> /usr/local/etc/php/conf.d/php.ini
USER root
RUN composer install --no-interaction

#RUN php artisan cache:clear && \
#    php artisan config:clear && \
#    php artisan view:clear && \
#    php artisan storage:link

# setup node js source will be used later to install node js
# RUN curl -sL https://deb.nodesource.com/setup_16.x -o nodesource_setup.sh
# RUN ["sh",  "./nodesource_setup.sh"]
RUN #npm install

#RUN php artisan migrate --seed
