#!/bin/bash

# Start Nginx
service nginx start

# Start PHP-FPM
exec php-fpm
