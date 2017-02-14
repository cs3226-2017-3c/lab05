# Developer Guide

This is only for lab of module CS3226 of NUS. This guide is for teammates to setup website locally correctly.

## Commit note
Put a tag like [M][V][C][Js] etc. at the front of commit note.


## Pull from server
1. Log in through Terminal/Putty, `ssh user@188.166.240.12` and key in your password.
2. Direct to Laravel project, `cd /var/www/html/cs3226`.
3. Pull from GitHub, `sudo git pull`, and key in your password (only for the first time of each session).

## Setup environment locally


### Download Composer and MySql

* [MySql](https://dev.mysql.com/downloads/mysql/) (remember the root password when installing)
* [Composer](https://www.dev-metal.com/install-update-composer-windows-7-ubuntu-debian-centos/)

### Setup Database Locally
Login to MySql as root.
```
$ mysql -u root -p
```
Create user <username> for app.
```
mysql > CREATE USER '<username>'@'localhost' IDENTIFIED BY '<custom_password>';

mysql > GRANT ALL PRIVILEGES ON * . * TO '<username>'@'localhost';
```
Create database.
```
mysql > create database <databasename>;
```

### Setup Web app locally

Create .env file
```
APP_ENV=local
APP_KEY=base64:qJ9XaWPFrfuutjgZ2RqUwPxUJlCriHYylwPM0uMIiE4=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<databasename>
DB_USERNAME=<username>
DB_PASSWORD=<custom_password>

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
NOCAPTCHA_SECRET=6LcNORUUAAAAAOdUag_7BMcrO8TvDiTXQiIdO4PW
NOCAPTCHA_SITEKEY=6LcNORUUAAAAAP1M_5IxmwVwwS3jAT87vtkzJKn-
```

Get latest version of this app from github.
Install dependencies.
```
$ composer install
```
Create table "students" in database.
```
$ php artisan migrate
(delete table $ php artisan migrate:reset)
```

Seed fake data into database.
```
$ php artisan db:seed --class=StudentsTableSeeder --env=local
```
Add two symbolic links
```
php artisan storage:link
ln -s <project directory>/vendor/components/flag-icon-css/flags <project directory>/public/flags
```


### Start Website locally
```
$ php artisan serve
```

## Current database schema
* Model ``Student``
  1. id => auto increment
  2. name 
  3. nickname
  4. kattis => kattis account
  5. country => 2-letter country code, e.g. SG, CN
  6. latest_score_id => nullable, but should not be null except creation
  7. avatar => path of uploaded avatar,  => nullable
  8. comment => nullable
  9. created_at 
  10. updated_at

* Model ``Scores`` 
  1. student_id
  2. mc => x,x,x,x,x,x,x,x,x : 0<=x<=4.0
  3. tc => x,y : 0<=x<=10.5, 0<=y<=13.5
  4. hw => x,x,x,x,x,x,x,x,x,x : 0<=x<=1.5
  5. bs  => x,x,x,x,x,x,x,x,x : 0<=x<=1
  6. ks => x,x,x,x,x,x,x,x,x,x,x,x : 0<=x<=1
  7. ac => x,x,y,y,x,x,z,x : 0<=x<=1, 0<=y<=3, 0<=z<=6 
  8. created_at 
  9. updated_at
