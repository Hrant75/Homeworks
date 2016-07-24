<?php

class DbConnection
{
    const HOST = "localhost";
    const DATABASE = "exam26";
    const USERNAME = "root";
    const PASSWORD = "ikarus";

    /**
     * @var PDO
     */
    private  $connection;

    public function __construct()
    {
        $conn = new PDO("mysql:host=".self::HOST.";dbname=".self::DATABASE, self::USERNAME, self::PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->connection = $conn;
    }

    public function getConnection(){
        return $this->connection;
    }
}