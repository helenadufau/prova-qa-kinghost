#!/bin/bash

# We need to install dependencies only for Docker
[[ ! -e /.dockerenv ]] && exit 0

set -xe

# Install git and wget (the php image doesn't have it) which is required by composer
apt-get update -yqq
apt-get install git -yqq
apt-get install wget -yqq

# Install phpunit 9
curl --location --output /usr/local/bin/phpunit https://phar.phpunit.de/phpunit-9.phar
chmod +x /usr/local/bin/phpunit

# Install composer dependencies
wget https://composer.github.io/installer.sig -O - -q | tr -d '\n' > installer.sig
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === file_get_contents('installer.sig')) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php'); unlink('installer.sig');"
php composer.phar install --no-suggest --no-progress --no-interaction