Comenius University online GeoGebra magazine
============================================


Install
-------
composer update
copy magazine/example.env.php to magazine/.env.php and update settings inside
php artisan migrate
php artisan migrate --package="liebig/cron"
php db:seed

Cron
php artisan cron:run