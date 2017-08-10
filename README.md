Comenius University online GeoGebra magazine
============================================


Install
-------
```shell
composer update

copy magazine/example.env.php to magazine/.env.php and update settings inside

php artisan migrate

php db:seed
```

Cron
----
``` shell
php artisan cron:run
```
