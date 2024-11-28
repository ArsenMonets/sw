<?php
/**
 * Class Connection
 * 
 * A singleton class that manages a database connection using environment variables.
 */
class Connection {
    /**
     * @var mysqli|null $connection Holds the single instance of the database connection.
     */
    private static $connection = null;
    /**
     * Establishes and returns a database connection.
     * 
     * - This method creates a database connection if it doesn't already exist.
     * - It loads environment variables from a `.env` file using the `dotenv` package.
     * - Utilizes the following environment variables:
     *   - `DB_HOST`: The hostname or IP address of the database server.
     *   - `DB_USERNAME`: The username for the database.
     *   - `DB_PASSWORD`: The password for the database.
     *   - `DB_NAME`: The name of the database.
     * 
     * @return mysqli The database connection object.
     */
    public static function connect() {
        if (self::$connection === null) {
            require_once dirname(dirname(__DIR__)) . 
            '/vendor/autoload.php';
            $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
            $dotenv->load();
            $host = $_ENV['DB_HOST'];
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];
            $db = $_ENV['DB_NAME'];
            self::$connection = mysqli_connect($host, 
                $username, $password, $db);
        }
        return self::$connection;
    }
}