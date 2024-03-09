## About this project
This project is part of my Web Technologies 2 course at University of Latvia. It's a simple videogame library management website. You can create a profile buy games and view them in your library.

## Functionality

See the store
Discounted games
New games
Top sellers

Add money
Buy games

View your library
"Play" games

Make friends
View friends profiles
See what they play and compare libraries

Search for games with filters
you can type in search game names, developers, tags
sort, filter by tags

Search developers
View developer profiles

View purchase history

Enjoy dynamic scrolling

As an admin you can
View admin panel
CRUD for games, developers, tags
Add and remove roles for users (developer, admin, user)

As a developer you can
CRUD for your developer games



## How to run
Check out the docker branch to only have to install docker on your system or follow the instruction below.

Setup WAMP.NET
1. Set up nginx, php and mysql
2. Create a site `steam.dev`
3. Clone this project in to the document root.
4. Change the document root to `public` folder
5. Start the php, mysql and nginx servers

Set up laravel and database
1. Clone the repository
2. Make sure you have installed
    - PHP
    - MySQL
    - composer
    - Node.js
3. Run `composer install`
4. Run `npm install`
5. Create .env file from .env.example
6. Set up your database
    - Create a schema name it `steamdev`
    - Create a user `steamdev` and grant all privileges to the schema
7. Migrate the database with `php artisan migrate`
8. Populate the database with `php artisan db:seed`
9. Generate a key with `php artisan key:generate`
10. Run `npm run dev`
11. Open the website from WAMP.NET

## premade profiles
login: admin@gmail.com
password: admin

login: developer@gmail.com
password: developer

login: parastais@gmail.com  
password: parastais
