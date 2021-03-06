# Symfony 5 & ReactJS boilerplate

## Introduction

This is an *experimental*, not tested in production, boilerplate for my future projects.
It works on a dockerized environment with the following stack :

    - Traefik
    - PHP7.4 / nginx
    - Symfony 5 (API Platform)
      - Monolog
      - Doctrine
    - ReactJS with the demo of Material kit by Tim creative
    - React admin
    - MySQL 5.7

The idea with this is to have one project for both front and back on top of
API first paradigm. I keep the project simple with the aim to be comfortable
to use and develop on.

## Installation
I advise you rename it when cloning :
- `git clone git@github.com:jonathangreco/APIplatform-react-admin-traefik-boilerplate.git`
- `cd <whatever you put for a name>
- Do a little customization on your containers (including mysql DB names and password)
- `make start`
- Go get a tea.
- Cleanup Book stuff (dummy example) when you ready to code your app
- Enjoy and give feedback or open issues !

### Api container
install vendor
populate an .env.local with at least this values (adapat it from your context)

```
DATABASE_URL="mysql://root:password@mysql:3306/database"


CORS_ALLOW_ORIGIN='^https?://(admin|front.docker.localhost)?$'

###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=your_secret
###< symfony/framework-bundle ###

JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=9c1f2e2fa339bfe93b094b5b1e2f9b4f

```

## Endpoints
### api.docker.localhost (accesible with postman)
- `/api/login` (POST) for a JWT authentication
- Create user by command LINE WITH :
  `bin/console app:create-user <email> <password> <username> <role>`

### admin.docker.localhost (require auth)
- Apply migrations (make migrate)
- Create your ROLE in the DB (ROLE_USER, ROLE_ADMIN, ROLE_SUPER_ADMIN) you can find an SQL file in `api/.docker/mysql/data`
- create a user first then log in there

### front.docker.localhost
- Material kit (or replaceable by whatever you want) -> just keep `Dockerfile` `.env` and `.dockerignore` file
  for docker-compose

## Monolog
- get a log file for your domain with the domain handler

just put :
```PHP
   public function __construct(\Psr\Log\LoggerInterface $domainLogger)
   {
        
   }   
```
as a dependancy to start logging in this handler

## (From api/readme.md) Symfony 5 API platform Core

### Generating JWT pem
```shell
mkdir -p config/jwt
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```
*.pem files maybe not readable, in that case use `chmod 644 private.pem` to make it works 
Passphrase is in .env file for your environment

## Caveats
- client uses npm && admin use yarn
- traefik is exposed (bad for production)
- this project is yet no tested in production (And I won't advise you to use it yet !)
- [Insert your caveats here it's probably the case...]


## Contributions
- If you are interested to invest some time on it you welcome. I would also appreciate your feedback / issues
  to make it better/
