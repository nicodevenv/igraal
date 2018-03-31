# Test description


The current project API can be launched using docker and provides 2 services :

- mysql : database will automatically be created using the mysql:5.6 image
- api : uses php:7.1-apache image and allow the use of php 7.1 running on a apache server.


Database file could be found into mysql folder.

A .env file could be found in the root of the current project and contains all environment variables that are used by api / front.

# Configuration

First get into api folder and use "composer install" and "composer update" to install and update project symfony 3.4 dependencies.

Go back to project root and use "docker-compose up". [It will install the environment and then initialize database content using mysql/igraal_evaluation.sql file]

You will be able to connect from host machine into docker database using theses data :

- user : igraal
- password : igraal
- port : 4306 (changed to prevent if 3306 is already in use by another sql server)
- host : localhost
- database name : igraal

The api is running in http://localhost:8000