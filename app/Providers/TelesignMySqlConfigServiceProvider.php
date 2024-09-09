<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TelesignMySqlConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Path to database.php.dist file
        $distFile = base_path('config/database.php.dist');

        // Read database.php.dist file
        $distContent = file_get_contents($distFile);

        // Path to the config.xml file outside the Laravel app directory
        $configFile = base_path('../config/webAppConfig.xml');

        // Read database.config.xml file
        $xml = simplexml_load_file($configFile);

        // Extract database connection details from XML
        $host = (string) $xml->database->host;
        $port = (string) $xml->database->port;
        $databaseName = (string) $xml->database->databaseName;
        $username = (string) $xml->database->username;
        $password = (string) $xml->database->password;

        // Replace placeholders with actual database connection details
        $distContent = str_replace(
            ['%host%', '%port%', '%database%', '%username%', '%password%'],
            [$host, $port, $databaseName, $username, $password],
            $distContent
        );

        // Path to database.php file
        $configFile = config_path('database.php');

        // Write modified content to database.php file
        file_put_contents($configFile, $distContent);
    }
}
