<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 13:42
 * Github       : https://github.com/moxspoy
 */

require_once 'constant.php';

class Database {
    private $conn = null;

    // get the database connection
    public function getConnection(){
        $this->conn = mysqli_connect(LOCAL_HOST, DB_USER, DB_PASSWORD);

        if($this->conn) {
            return $this->conn;
        } else {
            return "Connection failed: " . mysqli_connect_error();
        }
    }

    //Check if database was created, this function is solution if user not run 'migrate.php'
    public function isDatabaseCreated() {
        $this->conn = $this->getConnection();
        $select = mysqli_select_db($this->conn, DB_NAME);
        if($select) {
            return true;
        } else{
            return false;
        }
    }

    //Create database
    public function createDatabase() {
        $conn = $this->getConnection();

        $createDatabaseQuery = "CREATE DATABASE " . DB_NAME;
        if($conn->query($createDatabaseQuery)) {
            return "Database created successfully. You now can open index.php on root folder";
        } else {
            return "Error creating database: " . $conn->error;
        }
    }
}
?>