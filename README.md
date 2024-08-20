Telesign Web App 2.0

Requirements
Ensure you have the following installed on your local machine:

PHP >= 8.0
Composer

Getting Started
Follow these steps to set up the project on your local environment.

1. Clone the Repository
   First, clone the repository to your local machine:

 ```bash
    git clone https://github.com/Pantelija96/telesignWebApp.git
    cd your-repo-name
   ```
3. Install Dependencies
   Run the following commands to install the required dependencies:

```bash
composer install
```
3. Set Up the .env File
   Copy the example .env file and configure the environment variables:

```bash
cp .env.example .env
```

Then, open the .env file in your preferred editor and configure the necessary environment variables:

Contact: pantelijastosic@gmail.com   for info

# Run this command after setting the .env file
```
php artisan key:generate
```
4. Migrate and Seed the Database
   Run the following commands to migrate your database and optionally seed it with sample data:

```bash
php artisan migrate
php artisan db:seed   # Optional: if you have seeders to populate the database with data
```

5. Serve the Application
   You can serve the application locally using Laravel’s built-in development server:
```php artisan serve```

This will start the server at http://localhost:8000.

6. Additional Commands
   Here are a few additional commands you might need:

Clear Cache: If you make changes to the .env or configuration files:

```php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear```
