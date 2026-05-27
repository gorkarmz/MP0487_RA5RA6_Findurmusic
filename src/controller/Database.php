<?php

session_start();

class Database {
    private $conn;

    public function __construct()
    {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "mp0487_findurmusic";
        $db_port = 3306;

        try {
            $dsn = "mysql:host=$servername;dbname=$dbname;port=$db_port";
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>