.DEFAULT_GOAL := help
SHELL=/bin/bash
PHP_USER ?= www-data
DEV_UID ?= $(shell id -u)
DEV_GID ?= $(shell id -g)
DOCKER_COMPOSE = docker-compose
C ?=
PHP_RUN = $(DOCKER_COMPOSE) run --user "$(DEV_UID):$(DEV_GID)" --rm php

.PHONY: help
help: ## Display this help text
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-40s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

##
## Docker / docker-compose
## -----------------------
##

.PHONY: build-project
build-project: ## Build the docker-compose project
build-project:
	${DOCKER_COMPOSE} build

.PHONY: re-build-project
re-build-project: ## Rebuild the docker-compose project
re-build-project: down build-project

.PHONY: up
up: ## Up the docker containers
up:
	${DOCKER_COMPOSE} up -d $(c)

up-prod:
	# add services that you need for prod
	APP_ENV=prod ${DOCKER_COMPOSE} -f docker-compose.yml -f docker-compose.prod.yml up -d nginx php db

down: 
	${DOCKER_COMPOSE} down

stop: 
	${DOCKER_COMPOSE} stop $(c)

cmd?=list
console: 
	${DOCKER_COMPOSE} run --rm php php bin/console $(cmd)

schema-update:
	${DOCKER_COMPOSE} run --rm php php bin/console doctrine:schema:update -f

cache-clear:
	${PHP_RUN} bin/console cache:clear

composer-require:
	${DOCKER_COMPOSE} run --rm php composer require $(req)

composer-install: 
	${DOCKER_COMPOSE} run --rm php composer install

composer-install-prod: 
	${DOCKER_COMPOSE} run --rm php composer install -o

yarn-install:
	# To be log as the node user on the container and be allowed to use the npm/yarn cache (if you have a better way pls tell me)
	${DOCKER_COMPOSE} run --rm node yarn install

yarn-install-prod:
	# To be log as the node user on the container and be allowed to use the npm/yarn cache (if you have a better way pls tell me)
	${DOCKER_COMPOSE} run --rm node yarn install --prod

yarn-build:
	${DOCKER_COMPOSE} run --rm node yarn build

yarn-watch: 
	${DOCKER_COMPOSE} run --rm node yarn watch

new-push: 

# Change the name of the remote if you need 
deploy-test:
	git push test master

# deploy-prod:
#	git push prod master

#build-symfony-project : composer-install yarn-install yarn-build cache-clear cache-warm #if you use symfony encore
build-symfony-project : composer-install cache-clear cache-warm

#build-symfony-project-prod : composer-install-prod yarn-install-prod yarn-build cache-clear cache-warm #if you use symfony encore
build-symfony-project-prod : composer-install-prod cache-clear cache-warm

to-prod: stop up-prod build-symfony-project-prod

to-dev: stop up build-symfony-project

test:
	${DOCKER_COMPOSE} run --rm php vendor/bin/simple-phpunit

test-watch:
	${DOCKER_COMPOSE} run --rm php vendor/bin/phpunit-watcher watch
