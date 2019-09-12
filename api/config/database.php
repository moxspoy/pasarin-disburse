<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 13:42
 * Github       : https://github.com/moxspoy
 */


class Database {

    // Database credentials
    private $host = "localhost";
    private $db_name = "disburse";
    private $username = "root";
    private $password = "";
    public $conn;

    // get the database connection
    public function getConnection(){
        $this->conn = null;
        $this->conn = mysqli_connect($this->host, $this->username, $this->password);

        if($this->conn) {
            return $this->conn;
        } else {
            return "Connection failed: " . mysqli_connect_error();
        }
    }
}
?>