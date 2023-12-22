	Make instructions in English Instructions for deploying the project
1. Create a .env file in the project root and copy the standard .env.example file into it.
2. Set the necessary parameters using Composer: composer install.
3. Generate the application key: php artisan key:generate.
4. Connect to create tables in the database: php artisan migrate.
5. Run the Seeds to access the test data: php artisan db:seed --class=PositionSeeder and php artisan db:seed --class=DatabaseSeeder.
6. Start a local development server: php artisan serve.
