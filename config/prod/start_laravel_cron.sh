#!/bin/bash

cd /var/www/html

echo "-> Rodando Crons"
php artisan schedule:run
