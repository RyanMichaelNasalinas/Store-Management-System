<?php

class Database
{
    private $server = "mysql:host=localhost;dbname=store_db";
    private $user = "root";
    private $pass = "";
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    protected $conn;

    public function dbConn()
    {
        try {
            $this->conn = new PDO($this->server, $this->user, $this->pass, $this->options);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Error in the connection: " . $e->getMessage();
        }
    }

    public function dbClose()
    {
        return $this->conn = null;
    }

    public function dbUsers()
    {
        $stmt = $this->dbConn()->prepare("SELECT * FROM members");
        $stmt->execute();
        $users = $stmt->fetchAll();
        $userCount = $stmt->rowCount();

        return ($userCount > 0) ?  $users : 0;
    }

    public static function page404()
    {
        http_response_code(404);
        echo "<a href='all-products.php'>Back</a><br>";
        echo "Page not found";
        die;
    }
}
