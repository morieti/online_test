composer install
composer dump-autoload
cp .env.example .env

php artisan key:generate
php artisan envDBConnection:seed
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
