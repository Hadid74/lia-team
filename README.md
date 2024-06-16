

## About Project

This project is about an online store that was built for the technical interview of Lia Team.
The technologies used in this site are:

- MONGODB(Database)
- REDIS(Cache)
- PHPUNIT(TDD)
- JWT(Authentication)


## MONGODB CONFIG

First of all, the php_mongo.dll extension was installed along with its dependencies for php. After that, the mongodb server was installed on Windows.
After doing these things, mongodb can be accessed on http://localhost:27017

By changing the .env and config/database.php files, our Laravel project is connected to our mongodb database.


## REDIS CONFIG

The redis server was installed on wsl.
Instead of using phpredis as a php extension, predis was used. Our redis_client was changed to predis in .env .

Then run this command to start redis server on linux(wsl).
- **Run Redis Server:**
    ```bash
    sudo service redis-server start


## JWT CONFIG

- **Install JWT Package:**
    ```bash
    composer require tymon/jwt-auth

- **Publish Config:**
   ```bash
   php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

- **Generate secret key:**
   ```bash
   php artisan jwt:secret

.      This will update your .env file with something like JWT_SECRET=foobar

