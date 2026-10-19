# NORSU Student Record System

A simple CodeIgniter 4 CRUD application prepared as a teaching and demo project
for a NORSU web application development session. It manages a single
`students` table: list, add, view, edit, and delete.

The CodeIgniter application lives inside `src/`. The project root holds the
Warden local environment.

## What it demonstrates

- CodeIgniter 4 MVC (Route → Controller → Model → Database → View)
- Student CRUD with explicit routes
- MariaDB
- Database migrations
- Model validation
- CSRF protection
- Bootstrap 5 views with a shared layout
- Warden local development environment

## Requirements

- Docker
- [Warden](https://warden.dev)
- Git

## Local Setup

1. Clone the repository.

2. Start Warden from the project root:

   ```bash
   warden env up
   ```

3. Copy the example settings:

   ```bash
   cp src/.env.example src/.env
   ```

4. Install PHP dependencies if `src/vendor/` is missing:

   ```bash
   warden env exec -T php-fpm composer install
   ```

5. Run the migration:

   ```bash
   warden env exec -T php-fpm php spark migrate
   ```

6. Open:

   https://student-record-system.test/

## Useful commands

```bash
warden env exec -T php-fpm php spark routes          # list routes
warden env exec -T php-fpm php spark migrate:status  # migration state
warden env exec -T php-fpm php spark db:table students --show
```

## Project layout

```
src/app/Controllers/Students.php          CRUD controller
src/app/Models/StudentModel.php           students table + validation rules
src/app/Database/Migrations/              creates the students table
src/app/Views/layouts/main.php            shared Bootstrap layout
src/app/Views/students/                   index, create, show, edit
src/app/Config/Routes.php                 explicit student routes
```
