# Elite coding assessment

## installation
clone the project

```bash
    git clone git@github.com:Geodev06/Elite-assessment.git
```

navigate to project

```bash
    cd Elite-coding-assesment
```
install dependencies

```bash
   composer install
```

Note: must create the DB_DATABASE=elite  at .env before running migrations

run migrations and seed

```bash
    php artisan migrate --seed
```

start the server

```bash
    php artisan serve
```

open the browser and navigate to http://localhost:8000/


