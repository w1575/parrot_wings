## Parrot Wings

### Установка. 

1. ``docker run --rm \
   -v $(pwd):/opt \
   -w /opt \
   laravelsail/php80-composer:latest \
   composer install 
   ``
   
1.1 alias sail='bash vendor/bin/sail' 
2. `./vendor/bin/sail up -d`
3. `./vendor/bin/sail exec laravel.test  bash`
4. `php artisan migrate`
5. http://localhost:8080/ sudo@localhost.loc/password_0

