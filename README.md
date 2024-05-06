# Hotel booking service

## README.md

* en [English](README.md)
* ru [Русский](./readme/README.ru.md)

## Table of Contents

* [Project description](#project-description)
* [Technologies used in the backend part of the project](#technologies-used-in-the-backend-part-of-the-project)
* [Installation](#installation)
* [Configuration](#configuration)
* [Notes](#notes)

## Project description

An online hotel booking service, written in Laravel. A website for searching
for hotels and booking the rooms. The website features search, sorting and
filtering hotels, rooms and bookings.

## Technologies used in the backend part of the project

* `Laravel`
* `MySQL`
* `PHPStan`

## Installation

Steps for installing the project:

* Install Composer dependencies `composer install`
* Install npm dependencies `npm install`
* Add configuration to the `.env` file based on the `.env.example`
* Run migration and seeding `php artisan migrate:fresh --seed`
* Load Voyager BREAD forms with `php artisan voyager:load-bread`
* Clear the cache with `php artisan cache:clear` to refresh Voyager menu
* Copy image folders from `images/` to `storage/app/public/`
* Create link to the `storage` directory by running `php artisan storage:link`
* Run Vite bundling `npm run build` or start the watcher `npm run dev`
* Start the server with `php artisan serve`. Server is listening on `localhost:8000`

## Configuration

Configuration is inside the `.env` file. You can find examples in
the `.env.example` file.

## Notes

Tests are launched by using the command `php artisan test`.

`UserSeeder` creates accounts for testing: `user@example.com` and
`admin@example.com`. The password for both accounts is "password".

You can save Voyager administrator panel forms with
`php artisan voyager:save-bread`. The command requires root privileges to
execute.
