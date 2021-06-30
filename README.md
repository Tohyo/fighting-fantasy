# Fighting-fantasy

This project aim to recreate the books series `Fighting fantasy` on a website


## Installation

Install dependencies:

 * `composer install` inside the api container
 * `yarn` inside the frontend container

Set up the database:

 * `bin/console doctrine:schema:update --force`
 * `bin/console doctrine:fixtures:load`

Start the app:

 * `docker-compose up -d`

The app should be accessible at http://localhost:3000/
