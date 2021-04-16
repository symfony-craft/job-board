# Docker symfony website

This is a docker/docker-compose project to handle a symfony 4/5 website project. The project is based on nginx, php7.4, mariadb. There are also a node container to handle yarn (for symfony encore). The make commands allow you to interact, build and deploy the project easily.  
<br>
This template is also available with letsencrypt, just see the php7.4-letsencrypt branch.

### Starting a new project

##### Install docker

It depends on your environment, for ubuntu 18.4 see below

##### Clone this repository

<pre>$ git clone https://github.com/etienneleba/docker-symfony-website.git new-project-name</pre>
##### Create local files

- Create a .env.dev/.env.prod to store the env variables for the right environment
- Create a .env.local to store secrets
- Create a docker-compose.override.yml to set the ports

##### Choose the symfony version

In the docker-compose.yml, update the line :

<pre>SYMFONY_VERSION: ${SYMFONY_VERSION:-}</pre>

Example :

<pre>SYMFONY_VERSION: ${SYMFONY_VERSION:-5.*}</pre>

##### Set the mysql user password
In the docker-compose.yml : `MYSQL_PASSWORD:` 

##### Launch the project

The first time, up only the php container to install symfony :

<pre>$ docker-compose up php</pre>

After the installation, stop the php container and launch all the containers.

<pre>$ make up</pre>

##### Handle symfony encore

- [Install it](https://symfony.com/doc/current/frontend/encore/installation.html)
- Add yarn-install and yarn-build to the make command build-project

<br>

### Deploy to a server

##### On the server

###### Setup a bare git repository

- Follow this tutorial to set up a simple automated GIT Deployment : [Link](https://gist.github.com/noelboss/3fe13927025b89757f8fb12e9066f2fa#file-post-receive)

- Replace the post-receive script by the one of the project

- Install docker

##### On local

###### Add the bare repository to your local project

<pre>$ git remote add test ubuntu@your-server:project.git</pre>

###### Deploy to your server

<pre>$ make deploy-test</pre>

<br>

### Create production project

On the production server, add the ssl certificates inside the /docker/nginx/certs folder. Replace the filenames of the certificates in the prod.conf file and launch :

```
$ make to-prod
```

### Create maintenance mode

Require the corley maintenance bundle

```
$ make composer-require req=corley/maintenance-bundle
```

Create a corley.yaml config file with these lines :

```yaml
corley_maintenance:
  page: "%kernel.project_dir%/templates/maintenance.html"
  hard_lock: hard.html
  symlink: false
```

Create the maintenance.html file in the templates folder, this will be the maintenance page.

Dump the nginx config and add it to your nginx config the default one and the prod :

```
$ make console cmd=corley:maintenance:dump-nginx
```

It's all good, now you can lock or unlock your app. <br>  
Hard mode

```
$ make console cmd="corley:maintenance:lock on"
$ make console cmd="corley:maintenance:lock off"
```

Soft mode

```
$ make console cmd="corley:maintenance:soft-lock on"
$ make console cmd="corley:maintenance:soft-lock off"
```

Add these lines in the makefile to manage the maintenance mode more easily :

```
maintenance-soft-on:
	docker-compose run --rm php php bin/console corley:maintenance:soft-lock on
maintenance-soft-off:
	docker-compose run --rm php php bin/console corley:maintenance:soft-lock off
maintenance-hard-on:
	docker-compose run --rm php php bin/console corley:maintenance:lock on
maintenance-hard-off:
	docker-compose run --rm php php bin/console corley:maintenance:lock off
nginx-reload:
	docker-compose exec nginx nginx -s reload
```

### Ports

By default port 80 is use for the app and port 8080 is use for adminer. Don't forget to open them or close them on the server.

<br>

### Install docker ubuntu 18.4

<pre>$ sudo apt-get update && sudo apt-get install docker docker-compose</pre>
<pre>$ sudo usermod -aG docker $USER</pre>
<pre>$ sudo chmod 755 -R . </pre>

restart the machine

<br>

### Makefile commands

- build-project: build the docker-compose project
- up : launch the docker-compose project
- up-prod : launch only the production container with the prod config
- stop : stop the docker-compose project
- down : remove the docker-compose containers
- console : "php bin/console" throught the composer container, you can add a command with the "cmd" option
- schema-update : "php bin/console doctrine:schema:update -f" throught the composer container
- cache-clear : "php bin/console cache:clear" throught the composer container
- composer-require : "composer require" throught the composer container, you can add a package with the "req" option
- composer-install : "composer install" throught the composer container
- composer-install-prod : "composer install" throught the composer container, with -o option
- yarn-install : "yarn install" throught the node container
- yarn-install : "yarn install" throught the node container, with --prod option
- yarn-build : "yarn build" throught the node container
- yarn-watch : "yarn watch" throught the node container, lauch a server which update your assets during dev
- new-push : this command is used by the git hook : post-receive, to update your project on a server
- deploy-test : this command push your code on the server, don't forget to change the remote name or create other commands for each remote
- build-symfony-project : build the symfony project (install, cache clear, cache warm)
- build-symfony-project-prod : build the symfony project (install, cache clear, cache warm)
- to-prod : create the prod environnement, up-prod and build-symfony-project-prod
- to-dev : create the dev environnement, up and build-symfony-project

<br>

### Sources

- https://knplabs.com/en/blog/how-to-dockerise-a-symfony-4-project
- https://hackernoon.com/a-better-way-to-develop-node-js-with-docker-cd29d3a0093
- https://symfony.com/doc/current/setup/web_server_configuration.html
- https://github.com/dunglas/symfony-docker

<br>

### Contribute

- add tutorial to install docker/docker-compose on the different environment : red hat, centos...
- improve the makefile
- add comments in the dockerfile and makefile
