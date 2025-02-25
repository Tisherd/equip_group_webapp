FROM php:8.4-fpm

ARG APP_USER=laravel_user
ARG APP_UID=1000

RUN apt-get clean && apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    libxml2-dev \
    libzip-dev \
    libssl-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \
    exif \
    bcmath \
    gd \
    intl \
    xml \
    zip \
    opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug;
EXPOSE 9003

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer --version=2.7.0

# Set workdir
WORKDIR /var/www

# Composer install
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-progress --prefer-dist

# Copy project files
COPY . .

# create user if not exist
RUN if ! id -u ${APP_USER} > /dev/null 2>&1; then \
        useradd -ms /bin/bash -u ${APP_UID} ${APP_USER}; \
    fi

RUN chown -R ${APP_USER}:${APP_UID} storage bootstrap/cache

# Switch to the correct user
USER ${APP_USER}

# Launch php-fpm
EXPOSE 9000
CMD ["php-fpm"]
