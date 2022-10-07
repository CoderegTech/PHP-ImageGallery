<?php

class Dbh {
    private $hostname = "localhost";
    private $user = "root";
    private $passwd = "";
    private $dbname = "php_gallery";

    // Database Connection
    protected function connect() {
            try {
                    $dsn = "mysql:host=" . $this->hostname . ";dbname=" . $this->dbname . ";charset=utf8";

                    $pdo = new PDO($dsn, $this->user, $this->passwd);
                    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                    
                    return $pdo;

            } catch(Exception $e) {
                    echo "Database Error". $e->getMessage();
                    die();
            }

    }


}