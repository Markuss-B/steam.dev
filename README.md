![store_load](https://github.com/Markuss-B/steam.dev/assets/53609541/139bd4ae-bbb3-4cdb-b1b5-0a5f4a07f185)## About this project
This project is part of my Web Technologies 2 course at University of Latvia. It's a simple videogame library management website. You can create a profile buy games and view them in your library.

## Functionality

### See the store
Discounted games/New games/Top sellers
![store](https://github.com/Markuss-B/steam.dev/assets/53609541/d4dd9a22-e919-470a-9d13-7e8d5b1983c2)

### Add money
<img width="708" alt="money" src="https://github.com/Markuss-B/steam.dev/assets/53609541/02c091d8-961c-4ac5-8c33-f129d1c402de">

### Buy games
<img width="707" alt="game" src="https://github.com/Markuss-B/steam.dev/assets/53609541/5f8c576e-9998-4ddc-a218-f311a32a9b8a">

### View your library
"Play" games and see if your friends can play
<img width="1277" alt="library" src="https://github.com/Markuss-B/steam.dev/assets/53609541/e6714a51-745b-47a0-a04c-cdcafd2e7c2d">

### Make friends
<img width="718" alt="friends" src="https://github.com/Markuss-B/steam.dev/assets/53609541/d417d38c-e42c-41d8-bf3a-bd1506892e71">

### View profiles
See what they play and compare libraries
<img width="955" alt="profiles" src="https://github.com/Markuss-B/steam.dev/assets/53609541/032d563a-41bc-4169-8fae-bca70fc451ad">

### Search for games with filters
Search by game names, developers, tags
sort by price/name/release date and filter by tags
<img width="1007" alt="search" src="https://github.com/Markuss-B/steam.dev/assets/53609541/1d4f2b51-f484-495b-8930-8c5cb3087658">

### View developer profiles
<img width="1025" alt="developers" src="https://github.com/Markuss-B/steam.dev/assets/53609541/5a083224-eaaf-4396-85f8-e284f091d115">

### View purchase history
<img width="703" alt="history" src="https://github.com/Markuss-B/steam.dev/assets/53609541/9ec866bf-16a2-4626-b15f-ff30bf8a39e1">

### Enjoy dynamic scrolling and loading
![games_scroll](https://github.com/Markuss-B/steam.dev/assets/53609541/6ab68f77-2243-45ed-8845-c566e32c9d16)
![store_load](https://github.com/Markuss-B/steam.dev/assets/53609541/b59e8a01-f545-49c8-8a3e-36299b033762)


### As an admin you can
#### View admin panel
<img width="975" alt="admin_panel" src="https://github.com/Markuss-B/steam.dev/assets/53609541/ed20d0f9-b70b-4f11-81f5-be131a618679">

#### CRUD for games, developers, tags
![c_game](https://github.com/Markuss-B/steam.dev/assets/53609541/ccaeb75b-e7b4-4b6b-baf7-785b257626c9)
<img width="967" alt="c_dev" src="https://github.com/Markuss-B/steam.dev/assets/53609541/0701b812-96a4-40f0-ab15-4065a8eb100a">
<img width="954" alt="c_tag" src="https://github.com/Markuss-B/steam.dev/assets/53609541/a3766e66-e933-4964-8b15-ea6d75958868">
![e_game](https://github.com/Markuss-B/steam.dev/assets/53609541/5daf6b96-09ce-4a7b-8a93-0cdf4c47546c)
<img width="955" alt="e_dev" src="https://github.com/Markuss-B/steam.dev/assets/53609541/d1e0d3b3-397b-4914-bb16-8607209ff7cf">

#### Add and remove roles for users (developer, admin, user)
<img width="941" alt="roles" src="https://github.com/Markuss-B/steam.dev/assets/53609541/ffef63be-2554-4f91-9eed-6620b97ef4ce">
<img width="953" alt="add_dev_for_studio" src="https://github.com/Markuss-B/steam.dev/assets/53609541/46a238d8-1fd6-40ee-9087-b5b5e2786a33">

### As a developer you can
CRUD for your studio
<img width="1067" alt="dev_edit_game" src="https://github.com/Markuss-B/steam.dev/assets/53609541/b876b42e-abf0-4f0c-a7c4-7737358fbd8f">
<img width="1095" alt="dev_edit" src="https://github.com/Markuss-B/steam.dev/assets/53609541/8bde0dec-d150-4b60-a7f1-e5ca07e66381">



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
10. Link the storage with `php artisan storage:link`
11. Run `npm run dev`
12. Open the website from WAMP.NET

## premade profiles
login: admin@gmail.com
password: admin

login: developer@gmail.com
password: developer

login: parastais@gmail.com  
password: parastais
