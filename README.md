# Checkmate

Checkmate is a to do's application that lets you take notes of your tasks or ideas in orden to keep it always close to you, and help you in your daily work.

## Architecture
It's front side is made up with Vue and Vuetify, and it works as a single page application that interacts with the backend though HTTP requests.
The backend is built as an API with Laravel.
The authentication process suposes the need of users, that need to be authenticated with email and password. The HTTP transactions must be authorized by a API bearer token.

## Notes for development

### Unit/Feature Testing
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
