# php_oop_crud
This is a pure PHP CRUD blog app.

## Install
1. Clone the repo or download the zip to your locaolhost directory
2. Run `docker-compose up --build` or `docker-compose up --build -d` to run in detached mode
3. Once the service is up and running, the db needs to bee imported. to do so:
    1. Run `docker exec -it mysql-server bash -l` (the container's name is "mysql-server')
    2. Once you've entered the container, run `cd imports/`
    3. Then `mysql -u root -p oop_crud < oop_crud.sql`
4. Now you can go to http://192.168.99.100:9000/, whic is the default ip of docker on port 9000 which was specified in the Dockerfile and docker-compose.yml files

That is all that is required.

## Prerequisites
* Docker
* Docker-compose

## Technologies/Software
* PHP 7.3
* Docker & Docker-compose
* MySQL 8
