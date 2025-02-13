#!/bin/bash

# `cron` を起動
service cron start

# PHP-FPM も並行して起動
php-fpm
