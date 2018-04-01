# Test description

This is a basic project using Symfony 3.4 and ReactJs.

The current project API can be launched using docker and provides 2 services :

- mysql : database will automatically be created using the mysql:5.6 image
- api : uses php:7.1-apache image and allow the use of php 7.1 running on an apache server.


Database file could be found into mysql folder.

A .env file could be found in the root of the current project and contains all environment variables that the mysql service needs.

# Configuration

First get into api folder and use "composer install" and "composer update" to install and update project dependencies.

Next, go to "api/app/config/parameters.yml" and replace default doctrine data with the following values:
- database_host: mysql
- database_port: 3306
- database_name: igraal
- database_user: igraal
- database_password: igraal

Go back to project root and use "docker-compose up". [It will install the environment and then initialize database content using mysql/igraal_evaluation.sql file]

You will be able to connect from host machine into docker database using theses data :

- user : igraal
- password : igraal
- port : 4306 (changed to prevent if 3306 is already in use by another sql server)
- host : localhost
- database name : igraal

Go to "front" folder and run "yarn install" in order to install react app dependencies and then run "yarn start" to run front project

The api is now running in http://localhost:8000

The front is now running in http://localhost:3000

# Allowed routes

| MTHD | Route                               | Json parameters                   | Description                         |
|------|-------------------------------------|-----------------------------------|-------------------------------------|
| POST | localhost:8000/user/register        | name, password, email, profileUrl | Register an user                    |
| POST | localhost:8000/user/login           | password, email                   | Login with user authentication data |
| GET  | localhost:8000/commissions/{idUser} |                                   | Get user commissions                |
| GET  | localhost:8000/user/{idUser}        |                                   | Get user dara                       |

# Possible improvements

*API*
---

- Use of form validation constaints : https://symfony.com/doc/current/reference/constraints.html
- User login data via token : https://symfony.com/doc/current/security/api_key_authentication.html
- Catch status 404 / 500 and return json
- DataProvider for tests : https://phpunit.de/manual/current/en/appendixes.annotations.html#appendixes.annotations.dataProvider
- DoctrineFixtures for tests to make auto creation of data set (just like factories): https://symfony.com/doc/master/bundles/DoctrineFixturesBundle/index.html

*FRONT*
-----

- Use of React Router to navigate using links: https://reacttraining.com/react-router/
- Make a better design

(I'm actually novice on ReactJs, I don't have much more idea of what other libraries to use in order to improve / optimize react projects)

Hope you enjoy my work.
