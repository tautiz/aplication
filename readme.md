# Your COMPANY NAME here

This project was created by [Tautvydas Dulskis](https://www.linkedin.com/in/tautvydas-dulskis-3b83825a/).

## First time run 

### Build containers
Run `docker network create traefik` for traefik network creation.\
Next run `docker compose up -d` this will pull all necessary containers, builds it and runs application.\
And finally `docker run -v $(pwd):/app composer2_vendor composer install` to install all necessary vendors dependencies.\

### Setup Database
Run this command: `docker compose exec mysql sh /docker-entrypoint-initdb.d/db_init.sh`

### Setup hostname
In order we could access our app via local domain, we need to [edit Hosts file](https://www.howtogeek.com/howto/27350/beginner-geek-how-to-edit-your-hosts-file/) 
and add this line `127.0.0.1 application.local`.\
Now you can navigate to [http://application.local](http://application.local).

## Running container daily

Run `docker compose up -d` and open your project as usually `http://application.local`.

## Running unit tests

Run `docker compose exec app php vendor/bin/phpunit --testdox --colors=always --verbose tests` to execute the unit tests via [PHPUnit](https://phpunit.de/index.html).

## Further help

To get more help from [Tautvydas Dulskis](https://www.linkedin.com/in/tautvydas-dulskis-3b83825a/).

### Used vendors
* Router - [pecee/simple-router](https://github.com/skipperbent/simple-php-router)
* Dependency Injector - [php-di/php-di](https://php-di.org/)
* Logging - [monolog/monolog](https://packagist.org/packages/monolog/monolog)
* Unit Tests - [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit)
