

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

- Replace the <strong>Illuminate\Database\Schema\Blueprint</strong> import with <strong>MongoDB\Laravel\Schema\Blueprint</strong> if it is referenced in your migration 

- Replace the <strong>Illuminate\Database\Eloquent\Model</strong> import with <strong>MongoDB\Laravel\Eloquent\Model</strong> if it is referenced in your Model



By changing the .env and config/database.php files, our Laravel project is connected to our mongodb database.

- **Create Replica Set:** <br>
To use transactions in MongoDB, we must use replica mode(Using RefreshDatabase Traits in TestClass)
- First of all, to bring up Mongo in replica mode, we use this command in cmd
    ```bash
    mongod --dbpath="/path/MongoDB/data" --replSet rs0
- After that open another CMD and run this
    ```bash
    mongosh --host localhost --port 27017

- After that open another CMD and run this
    ```bash
    rs.initiate({
  _id: "rs0",
  members: [
    { _id: 0, host: "localhost:27017" }
  ]
})

## REDIS CONFIG

The redis server was installed on wsl.
Instead of using phpredis as a php extension, predis was used. Our redis_client was changed to predis in .env .

Then run this command to start redis server on linux(wsl).
- **Run Redis Server:**
    ```bash
    sudo systemctl start redis-server


## PHPUNIT CONFIG
Used MongoDB fot testing purpose 
- First f all,create a .env.testing file

- copy these configuration in it

      DB_CONNECTION=mongodb
      MONGO_DB_HOST=127.0.0.1
      MONGO_DB_PORT=27017
      MONGO_DB_DATABASE=test_database


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

