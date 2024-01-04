FROM dunglas/frankenphp

RUN install-php-extensions pcntl zip pdo_pgsql pgsql

COPY . /app

ENTRYPOINT ["php", "artisan", "octane:frankenphp"]
