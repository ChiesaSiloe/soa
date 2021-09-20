FROM webdevops/php-nginx:7.4-alpine

# Install Laravel framework system requirements (https://laravel.com/docs/8.x/deployment#optimizing-configuration-loading)
RUN apk add oniguruma-dev postgresql-dev libxml2-dev
# RUN docker-php-ext-install \
#         bcmath \
#         ctype \
#         fileinfo \
#         json \
#         mbstring \
#         tokenizer \
#         xml \
#         sqlite3

# Copy Composer binary from the Composer official Docker image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production
WORKDIR /app
COPY . .

RUN composer install --no-interaction --optimize-autoloader --no-dev

# Database prep
RUN touch database/database.sqlite

RUN php artisan migrate --force

# Setting up Orchid platform
RUN php artisan orchid:install

RUN php artisan orchid:admin admin admin@admin.com password

# Optimizing Configuration loading
RUN php artisan config:cache
# Optimizing Route loading
RUN php artisan route:cache
# Optimizing View loading
RUN php artisan view:cache

RUN chown -R application:application .