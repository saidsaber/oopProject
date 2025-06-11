<?php
namespace App\Model;
use PDO;
use PDOException;


$config = [
    "host" => "localhost",
    "dbname" => "book_store",
    "username" => "root",
    "password" => "",
];


class Config
{
    private static ?Config $instance = null;
    private PDO $connection;

    private function __construct(array $config)
    {
        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
            $this->connection = new PDO($dsn, $config['username'], $config['password']);
        } catch (PDOException $th) {
            die($th->getMessage());
        }
    }

    public static function getInstance(array $config): Config
    {
        if (self::$instance === null) {
            self::$instance = new self(($config));
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}

$db = Config::getInstance($config)->getConnection();