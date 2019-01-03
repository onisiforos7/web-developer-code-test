<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


## Instructions
In order to run you will need composer. 


1. Download project.
2. Set up Virtual Host
3. Set up the Database:
  Edit .env file, I am using localhost and vagrant default credentials with the database name Web_dev_test.
  
        DB_CONNECTION=mysql <br>
        DB_HOST=127.0.0.1 <br>
        DB_PORT=3306 <br>
        DB_DATABASE=web_dev_test <br>
        DB_USERNAME=homestead <br>
        DB_PASSWORD=secret <br>

  
4. Run Migraitons & Seeds in order to get the tables and Action Items from Data file provided in Code Test.

  php artisan migrate --seed

## Notes

No users were included in seed method, if migration and seeding was succesfull you have the tables and the action items, you will need to register a new user (no email confirmation needed).

I have included some tests about the authentication.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
