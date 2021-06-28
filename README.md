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
2 `alias sail='bash vendor/bin/sail'`
3. `sail up -d`
4. `sail artisan migrate`
6. `sail npm run build`
6 http://localhost:8080/ sudo@localhost.loc/password_0

