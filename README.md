## Parrot Wings

### Установка. 

1. ```
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
   ```
2. `./vendor/bin/sail up -d`
3. `./vendor/bin/sail exec laravel.test  bash`
4. `php artisan migrate`
5. http://localhost:8080/ sudo@localhost.loc/password_0

