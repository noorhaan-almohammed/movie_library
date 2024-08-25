# Laravel Movies Library Api

A simple Movies Library Api with Laravel 11.
You can add ,update,show and delete movies ,users or ratings too.
First run creating collection to create a movie then a user and finally the rating ,Absolutley you can't create rating of movie or user not excist also user can't rate the same movie twice .
(movie_id , user_id) is index can't be repeate .
```
https://api.postman.com/collections/12600872-836a3712-9d85-41c7-86ab-2ba7b2e3f67e?access_key=PMAT-01J65BQC3BRQJ42YMSA763JM89
```
Second run showing collection .
```
https://api.postman.com/collections/12600872-47324afa-31d7-47ea-bf33-d5fe0db588ad?access_key=PMAT-01J65BVNT31NH7QGFGFFQCDX7J
```
Third run updating collection .
```
https://api.postman.com/collections/12600872-92c9fc9f-b731-401b-b3e9-c7704853cd3a?access_key=PMAT-01J65BWNXK396WTZQGE3V5ZDD2
```
Finally Delete all by run destroying collection .
```
https://api.postman.com/collections/12600872-eb83e42f-6fa5-4c84-aa8b-831d0bf94b87?access_key=PMAT-01J65BND59K7RYBSJ6YY8BDDCW
```
##

## Installation

Clone the repository-

```
git clone https://github.com/noorhaan-almohammed/movie_library.git
```

Then cd into the folder with this command-

```
cd Movie-library
```

Then do a composer install

```
composer install
```

Then do a npm install

```
npm install
```

Then create a environment file using this command-

```
cp .env.example .env
```

Then edit `.env` file with appropriate credential for your database server. Just edit these two parameter(`DB_CONNECTION`,`DB_DATABASE`,`DB_USERNAME`, `DB_PASSWORD`).

Then create a database named `movies-library` and then do a database migration using this command-

```
php artisan migrate
```

## Run server

Run server using this command-

```
php artisan serve
```

Then go to `http://localhost:8000` from your browser and see the app.

