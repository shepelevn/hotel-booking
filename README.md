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

Hotel booking online service written in Laravel. A website for searching
hotels and book the rooms. The website features search, sorting and
filtering hotels, rooms and bookings.

## Technologies used in the backend part of the project

* `Laravel`
* `MySQL`
* `PHPStan`

## Installation

Steps for installing the project:

* Install Composer dependencies `composer install`
* Install npm dependencies `npm install`
* Add configuration to `.env` file based on `.env.example`
* Run migration and seeding `php artisan migrate:fresh --seed`
* Load Voyager BREAD forms with `php artisan voyager:load-bread`
* Clear the cache with `php artisan cache:clear` to refresh Voyager menu
* Copy image folders from `images/` to `storage/app/public/`
* Create link to `storage` directory by running `php artisan storage:link`
* Run Vite bundling `npm run build` or start the watcher `npm run dev`
* Start the server with `php artisan serve`. Server is listening on `localhost:8000`

## Configuration

Configuration is inside `.env` file. You can find examples in
`.env.example` file.

## Notes

Tests are launched by using the command `php artisan test`.

`UserSeeder` creates accounts for testing: `user@example.com` and
`admin@example.com`. The password is "password".

You can save Voyager administrator panel forms with
`php artisan voyager:save-bread`. The command needs root privileges.
