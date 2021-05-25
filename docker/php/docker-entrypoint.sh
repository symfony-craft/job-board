#!/bin/sh
# from https://github.com/dunglas/symfony-docker
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

# Change www-data's uid & guid to be the same as the .env file in the host
sed -ie "s/`id -u www-data`:`id -g www-data`/`stat -c %u /usr/src/.env`:`stat -c %g /usr/src/.env`/g" /etc/passwd

if [ "$1" = 'php-fpm' ]; then
	PHP_INI_RECOMMENDED="$PHP_INI_DIR/php.ini-production"
	if [ "$APP_ENV" != 'prod' ]; then
		PHP_INI_RECOMMENDED="$PHP_INI_DIR/php.ini-development"
	fi
	ln -sf "$PHP_INI_RECOMMENDED" "$PHP_INI_DIR/php.ini"

  mkdir -p var/cache var/log

  # The first time volumes are mounted, the project needs to be recreated
  if [ ! -f composer.json ]; then
      composer create-project "symfony/skeleton $SYMFONY_VERSION" tmp --prefer-dist --no-progress --no-interaction
      jq '.extra.symfony.docker=true' tmp/composer.json > tmp/composer.tmp.json
      rm tmp/composer.json
      mv tmp/composer.tmp.json tmp/composer.json
      rm tmp/.gitignore
      rm tmp/.env

      chown -Rf www-data:www-data ./tmp
      cp -Rp tmp/. .
      rm -Rf tmp/
  elif [ "$APP_ENV" != 'prod' ]; then
      rm -f .env.local.php
      composer install --prefer-dist --no-progress --no-suggest --no-interaction
  fi

fi

if [ "$1" = 'sh' ] || [ "$1" = 'bin/console' ] || [ "$1" = 'composer' ] || [ "$1" = 'php' ]; then
  # Change to user www-data
  su www-data -s /bin/sh -c "$*"
fi

exec docker-php-entrypoint "$@"
