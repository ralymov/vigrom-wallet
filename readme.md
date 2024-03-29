# Copy and run project

1. Clone this repository.
2. Change directory to created `cd project`.
3. Install composer packages `composer install`.
4. Install yarn packages `yarn install`.
5. Copy example `.env` file (`cp .env.example .env`).
6. Generate application key `php artisan key:generate`.
7. Fill in the required data in the `.env` file (database credentials, `CURRENCY_API_KEY`).
8. Run migration `php artisan migrate`.
9. Run references table seeders `php artisan db:seed`.
10. Import currencies exchange rates `php artisan currency:import`.
11. (**Optional**) Run users table seeder for testing purposes `php artisan db:seed --class=UsersTableSeeder`.
12. Start a development server at http://localhost:8000 `php artisan serve`.
  
  
### Application deployment requirements

* PHP >= 7.2.0.
* BCMath PHP Extension.
* Ctype PHP Extension.
* JSON PHP Extension.
* Mbstring PHP Extension.
* OpenSSL PHP Extension.
* PDO PHP Extension.
* Tokenizer PHP Extension.
* XML PHP Extension.
* Database PDO Extension.
* Composer.

### .env variables

* `CURRENCY_API_KEY` - [Open Exchange Rates](https://docs.openexchangerates.org/) account App ID, 
which using to access currency exchange rates API.
