# Checkmate

Checkmate is a to do's application that lets you take notes of your tasks or ideas in orden to keep it always close to you, and help you in your daily work.

## Architecture
It's front side is made up with Vue and Vuetify, and it works as a single page application that interacts with the backend though HTTP requests.
The backend is built as an API with Laravel.
The authentication process suposes the need of users, that need to be authenticated with email and password. The HTTP transactions must be authorized by a API bearer token.

## Notes for development


### Environment variables
The required environment configuration is the database access data section of the .env file. You can find an example in .env.example. 
It is also neccesary to set the VITE_API_BASE_URL variable. It's value has to be built with the base url of your service, plus '/api/', for example:
```
VITE_API_BASE_URL="http://localhost:8000/api/"
```
It is important because is the address Axios will use to make request to the server.

### Running the project
If running the project for the first time, you must install dependencies with:
```
composer install

npm install
```
Also, you have to generate just once a key for Laravel with the command
```
php artisan key:generate
```

After that, the settings are done. Now, paralelly, is required to run two commands in different terminals with the commands:
``` 
php artisan serve 
```
and
```
npm run dev
```
By default, the application will be running (both front and back ends) in port 8000.
### Testing
#### Backend Unit/Feature Testing
The backend testing is provided by Laravel. To run the tests, you must serve a testing database and set its name in phpunit.xml env variable ```DB_DATABASE```.

Laravel will take care of the proper migrations. Since the tests suite clears the database before each test, it is really important to not use another database that is not just for testing.

After that, no other settings are needed, so you can just run:
```
php artisan test
```
If the database configuration is not enough (for example, if it is served in a different host from your regular database), set its access data in .env.testing and then run the tests specifiyng this environment file with the option ```--env=testing```. You just need to set the next variables:
```
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

#### Frontend testing
No configuration is needed to run test on the frontend, just having node installed.
```
npm run test
```
This command will run the tests with vitest in watch mode. For other options, look for help with the -h option.
Because of the console print a huge number of warning related to Vue components, the vite.config.js has compiler options that are commented for the normal execution of the application, but can be uncommented while testing to avoid anoying alerts.