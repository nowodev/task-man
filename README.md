# TASKMAN


## Requirements

The following should be isntalled on your local machine
1. PHP 8.1
2. Mysql
3. Node
4. NPM

## Installation

1. Unzip the file titled `taskman`
2. Open terminal and cd into directory

3. Create a mysql database called 'taskman'
4. Open the `.env` file and edit the `DB_USERNAME & DB_PASSWORD` to suit the one you have set on your local mysql
5. Migrate the database

```bash
php artisan migrate
```
6. Run the seeder

```bash
php artisan db:seed
```
7. Serve the project

```bash
php artisan serve
```
8. Bundle the assets

```bash
npm run dev
```
