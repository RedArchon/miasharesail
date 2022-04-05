## Setup

This project was built using [Laravel Sail](https://laravel.com/docs/9.x/sail#main-content). It's recommended that you have Docker installed before continuing.
- `git clone https://github.com/RedArchon/miasharesail.git`
- create a copy of `.env.example` and name the file `.env`
- cd into the new project's directory and run `composer install`
- `php artisan key:generate`
- `./vendor/bin/sail build --no-cache` or use whichever alias you may have set for `./vendor/bin/sail`
- `./vendor/bin/sail up`
- Configure your MySQL connection using the credentials provided in `.env` and create a schema/database named `miasharesail`
- `php artisan sail:install` and choose `mysql`
- Run `./vendor/bin/sail artisan migrate:fresh --seed`
- `./vendor/bin/sail npm install && npm run dev`
- `./vendor/bin/sail artisan queue:work`
- Open your browser and head to `miasharesail.test`
- Navigate to the Login page and login using one of the two seeded user accounts:
`admin@miashare.test` `Password2022!` or `user@miashare.test` `Password2022!`

Task: 
```
User authentication and authorization

Two roles: user and administrator

Administrator has full permissions

User can only create and delete their own to-do items

Users can create a to-do list

Users can mark to-do items as done

Users can delete to-do items

Administrators can see all users to-do items, including deleted to-do items
```
