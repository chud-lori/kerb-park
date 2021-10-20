# KERB Parking app

## Requirements

-   PHP 7.\*
-   Postgresql

## Set Up

-   `cp .env.example .env`
-   Run `composer install` to install the dependencies

<!-- ## Run Test
```bash
pytest -vv
``` -->

## Run

Run this command and access the web app at `localhost:5000`

```bash
php artisan schedule:run
php artisan serve
```

<!-- ## Run in docker
```bash
docker build -t geocode-flask:1.0 .
docker run --name flaskgeo -d -p 5000:5000 --env FLASK_APP=setup.py --env FLASK_ENV=production geocode-flask:1.0
```
Access `localhost:5000` and input the destination

## How to use
* Make sure the application running well using above instructions
* Access `http://localhost:5000`
* Type the destination and hit 'Get'
* The result will served in json format if valid, otherwise will return with several status code, list of status code
    - 0: location or destination not found
    - 1: resulting destination and origin distance
    - 2: distance between origin and destination not found, destination might too far from origin
    - 3: destination location is inside origin's area -->

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
