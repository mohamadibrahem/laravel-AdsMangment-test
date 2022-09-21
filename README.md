<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Usage

This is not a package - it's a full Laravel project that you should use as a starter boilerplate, and then add your own custom functionality.

- Clone the repository with `git clone`
- Copy `.env.example` file to `.env` and edit database credentials there
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate --seed` (it has some seeded data - see below)
- launch the main URL via: `php artisan serve` then after that's can view dashboard
- That's it: launch the main URL and login with default credentials `admin@admin.com` - `password`

# How use API in this project
- can use api for postman: `domain-name.example/api/v1/ads` view all ads - required method `GET`
- can use api for postman: `domain-name.example/api/v1/ads/create` create new ads - required method `POST`
- can use api for postman: `domain-name.example/api/v1/ads/update/{id}` edit {id} ads - required method `PUT`
- can use api for postman: `domain-name.example/api/v1/ads/{id}` delete {id} ads - required method `DELETE`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
"# laravel-AdsMangment-test" 
