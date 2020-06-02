## Todo app

- To run tests browse to `/todo` folder and run `php artisan test`
- Backend tests are in `/todo/tests/Feature` folder
- To run the app browse `/todo/public` to and run `php -S localhost:8080` then browse `http://localhost:8080`
- Simple client app coded in angular is provided in `/todoclient`, it's compiled into `/todo/public/app`
- Backend app uses a SQLite database, app needs write permission on the `/todo` folder in order to create it
- Tests uses an in memory SQLite database