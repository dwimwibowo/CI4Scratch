# Udemy - Codeigniter 4 from scratch 2022

https://www.udemy.com/course/codeigniter-4-from-scratch-2022/

**Using:**
- CodeIginiter 4.1.5
- Bootstrap 5

###########################################################################################################
**List commands:**
- php spark --help

CodeIgniter v4.1.7 Command Line Tool - Server Time: 2022-01-16 05:57:48 UTC-06:00

Cache
  cache:clear        Clears the current system caches.
  cache:info         Shows file cache information in the current system.

CodeIgniter
  env                Retrieves the current environment, or set a new one.
  help               Displays basic usage information.
  list               Lists the available commands.
  namespaces         Verifies your namespaces are setup correctly.
  publish            Discovers and executes all predefined Publisher classes.
  routes             Displays all of user-defined routes. Does NOT display auto-detected routes.
  serve              Launches the CodeIgniter PHP-Development Server.

Database
  db:create          Create a new database schema.
  db:seed            Runs the specified seeder to populate known data into the database.
  migrate            Locates and runs all new migrations against the database.
  migrate:refresh    Does a rollback followed by a latest to refresh the current state of the database.
  migrate:rollback   Runs the "down" method for all migrations in the last batch.
  migrate:status     Displays a list of all migrations and whether they've been run or not.

Encryption
  key:generate       Generates a new encryption key and writes it in an `.env` file.

Generators
  make:command       Generates a new spark command.
  make:config        Generates a new config file.
  make:controller    Generates a new controller file.
  make:entity        Generates a new entity file.
  make:filter        Generates a new filter file.
  make:migration     Generates a new migration file.
  make:model         Generates a new model file.
  make:scaffold      Generates a complete set of scaffold files.
  make:seeder        Generates a new seeder file.
  make:validation    Generates a new validation file.
  migrate:create     [DEPRECATED] Creates a new migration file. Please use "make:migration" instead.
  session:migration  [DEPRECATED] Generates the migration file for database sessions, Please use  "make:migration --session" instead.

Housekeeping
  debugbar:clear     Clears all debugbar JSON files.
  logs:clear         Clears all log files.

###########################################################################################################
- Create Project
composer create-project codeigniter4/appstarter project-name

- Running Spark Server
php spark serve

- Check Routes
php spark routes

- Generate New Controller
php spark make:controller #controller_name

- Generate Migration
php spark make:migration #name --table

- Run Migration to Database
php spark migrate

- Rollback Database Migration
php spark migrate:rollback

- Generate New Model
php spark make:model #model_name

- Generate Data Seeder
php spark make:seeder #seeder_name

- Run Data Seeder
php spark db:seed #seeder_name

- Third Party Library
composer require components/jquery
composer require twbs/bootstrap:5.0.2
composer require twbs/bootstrap-icons
composer require tatter/assets
composer require almasaeed2010/adminlte

###########################################################################################################

- Sample Routes Output
$ php spark routes (presenter)

+--------+----------------------------+------------------------------------------------+
| Method | Route                      | Handler                                        |
+--------+----------------------------+------------------------------------------------+
| GET    | /                          | \App\Controllers\Portal\HomeController::index  |
| GET    | admin                      | \App\Controllers\Admin\HomeController::index   |
| GET    | admin/user                 | \App\Controllers\Admin\User::index             |
| GET    | admin/user/show/(.*)       | \App\Controllers\Admin\User::show/$1           |
| GET    | admin/user/new             | \App\Controllers\Admin\User::new               |
| GET    | admin/user/edit/(.*)       | \App\Controllers\Admin\User::edit/$1           |
| GET    | admin/user/remove/(.*)     | \App\Controllers\Admin\User::remove/$1         |
| GET    | admin/user/(.*)            | \App\Controllers\Admin\User::show/$1           |
| POST   | admin/user/create          | \App\Controllers\Admin\User::create            |
| POST   | admin/user/update/(.*)     | \App\Controllers\Admin\User::update/$1         |
| POST   | admin/user/delete/(.*)     | \App\Controllers\Admin\User::delete/$1         |
| POST   | admin/user                 | \App\Controllers\Admin\User::create            |
+--------+----------------------------+------------------------------------------------+

$ php spark routes (resource)

+--------+----------------------------+------------------------------------------------+
| Method | Route                      | Handler                                        |
+--------+----------------------------+------------------------------------------------+
| GET    | /                          | \App\Controllers\Portal\HomeController::index  |
| GET    | admin                      | \App\Controllers\Admin\HomeController::index   |
| GET    | admin/user                 | \App\Controllers\Admin\User::index             |
| GET    | admin/user/new             | \App\Controllers\Admin\User::new               |
| GET    | admin/user/(.*)/edit       | \App\Controllers\Admin\User::edit/$1           |
| GET    | admin/user/(.*)            | \App\Controllers\Admin\User::show/$1           |
| POST   | admin/user                 | \App\Controllers\Admin\User::create            |
| PATCH  | admin/user/(.*)            | \App\Controllers\Admin\User::update/$1         |
| PUT    | admin/user/(.*)            | \App\Controllers\Admin\User::update/$1         |
| DELETE | admin/user/(.*)            | \App\Controllers\Admin\User::delete/$1         |
+--------+----------------------------+------------------------------------------------+