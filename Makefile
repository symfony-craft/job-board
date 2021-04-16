build-project:
	docker-compose build 

re-build-project: down build-project

up:
	docker-compose up -d $(c)

up-prod:
	# add services that you need for prod
	APP_ENV=prod docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d nginx php db

down: 
	docker-compose down

stop: 
	docker-compose stop $(c)

cmd?=list
console: 
	docker-compose run --rm php php bin/console $(cmd)

schema-update:
	docker-compose run --rm php php bin/console doctrine:schema:update -f 

cache-clear:
	docker-compose run --rm php php bin/console cache:clear 

composer-require:
	docker-compose run --rm php composer require $(req)

composer-install: 
	docker-compose run --rm php composer install 

composer-install-prod: 
	docker-compose run --rm php composer install -o

yarn-install:
	# To be log as the node user on the container and be allowed to use the npm/yarn cache (if you have a better way pls tell me)
	LOCAL_USER=1000 docker-compose run --rm node yarn install 

yarn-install-prod:
	# To be log as the node user on the container and be allowed to use the npm/yarn cache (if you have a better way pls tell me)
	LOCAL_USER=1000 docker-compose run --rm node yarn install --prod

yarn-build:
	docker-compose run --rm node yarn build

yarn-watch: 
	docker-compose run --rm node yarn watch

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