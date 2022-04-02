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
.PHONY: up-prod
up-prod: ## Up the docker containers for the prod environment
up-prod:
	# add services that you need for prod
	APP_ENV=prod ${DOCKER_COMPOSE} -f docker-compose.yml -f docker-compose.prod.yml up -d nginx php db

.PHONY: down
down: ## Stop and kill the docker containers
down:
	${DOCKER_COMPOSE} down

.PHONY: stop
stop: ## Stop the docker containers
stop:
	${DOCKER_COMPOSE} stop $(c)

##
## Symfony
## -----------------------
##

.PHONY: cache
cache: ## Clear the symfony cache
cache:
	${PHP_RUN} bin/console cache:clear

##
## Back dependencies
## -----------------------
##

.PHONY: install-back-dependencies
install-back-dependencies: ## Install the back dependencies
install-back-dependencies:
	${DOCKER_COMPOSE} run --rm php composer install

##
## Front dependencies
## -----------------------
##

.PHONY install-front-dependencies:
install-front-dependencies: ## Install the front dependencies
install-front-dependencies:
	# To be log as the node user on the container and be allowed to use the npm/yarn cache (if you have a better way pls tell me)
	${DOCKER_COMPOSE} run --rm node yarn install
