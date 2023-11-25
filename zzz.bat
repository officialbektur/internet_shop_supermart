@echo off
cd C:\OpenServer\domains\server\testingphp\laravel\internet_shop
start cmd /k npm run dev & php artisan serve
