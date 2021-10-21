# KERB Parking app

## Requirements

-   PHP 7.\*
-   Postgresql

## Set Up

-   `cp .env.example .env`
-   `composer update`
-   `composer install`

<!-- ## Run Test
```bash

``` -->

## Import database file

You can import postgresql database in file called kerb.sql

## Run

Run this command and access the app at `localhost:8000`

```bash
php artisan migrate
php artisan db:seed
php artisan schedule:work
php artisan serve
```

<!-- ## Run in docker

```bash
docker build -t kerb:1.0 .
docker run --name kerbapp -d -p 8000:80 kerb:1.0
```

Access `localhost:8000` and input the destination -->

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
