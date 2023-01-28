#!/bin/sh

# create an alias for composer
shopt -s expand_aliases
alias composer=/opt/cpanel/composer/bin/composer
readonly HOME=~
export HOME

# activate maintenance mode
php artisan down

# allow rebasing by default, because release/staging will diverge at every build (because of force push)
git config pull.rebase true


# checkout to build branch
git checkout -b release/staging

# update source code
git pull origin release/staging

# update PHP dependencies
composer install --no-interaction --prefer-dist
# --no-interaction Do not ask any interactive question
# --no-dev  Disables installation of require-dev packages.
# --prefer-dist  Forces installation from package dist even for dev versions.

# update database
php artisan migrate --force
# --force  Required to run when in production.

# stop maintenance mode
php artisan up
