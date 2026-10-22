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

## Deployment with GitHub Actions

Every push to `main` runs `.github/workflows/deploy.yml`, which connects to the
production server over SSH and performs the same steps as a manual deployment.
It can also be started by hand from the **Actions** tab (**Deploy to production
→ Run workflow**).

Required repository secrets (Settings → Secrets and variables → Actions):

| Secret            | Contents                                                   |
|-------------------|------------------------------------------------------------|
| `SSH_HOST`        | Server hostname or IP                                      |
| `SSH_PORT`        | SSH port, normally `22`                                    |
| `SSH_USER`        | Deployment user on the server                              |
| `SSH_PRIVATE_KEY` | Private half of a dedicated `github-actions-deploy` key    |
| `SSH_KNOWN_HOSTS` | Server host key from `ssh-keyscan -H <host>`, verified     |
| `DEPLOY_PATH`     | Absolute path of this repository's clone on the server     |

The production `src/.env` is created once on the server and is never stored in
GitHub. The workflow refuses to deploy if the server copy has local
modifications.

Manual deployment, if Actions is unavailable:

```bash
ssh user@server
cd /path/to/student-record-system
git pull origin main
cd src
composer install --no-dev --optimize-autoloader
php spark migrate
php spark cache:clear
```
