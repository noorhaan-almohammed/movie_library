# Laravel Movies Library Api

A simple Movies Library Api with Laravel 11.
You can add ,update,show and delete movies ,users or ratings too.
First run creating collection to create a movie then a user and finally the rating ,Absolutley you can't create rating of movie or user not excist also user can't rate the same movie twice .
(movie_id , user_id) is index can't be repeate .
Second run showing collection .
Third run updating collection .
Finally Delete all by run destroying collection .
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

