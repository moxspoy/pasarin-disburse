<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 13:42
 * Github       : https://github.com/moxspoy
 */

require_once '../config/constant.php';

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

    //Function to check database in every page
    public function settingUpDatabase() {
        if(!$this->isDatabaseCreated()) {
            $message = $this->createDatabase();
            echo "<script>alert('" . $message . "')</script>";
        }
    }

    //Check if database was created, this function is solution if user did not run 'migrate.php'
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

    //Save to database from json
    public function insert ($json_data) {
        $conn = $this->getConnection();
        mysqli_select_db($conn, DB_NAME);
        $tableName = DB_TABLE_NAME;

        $checkQuery = "SELECT 1 FROM '$tableName' LIMIT 1";
        if(!$conn->query($checkQuery)) {
            $createTableQuery = 'CREATE TABLE disburse (
                    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    id_from_api VARCHAR(30),
                    amount INT(30) NOT NULL,
                    status VARCHAR(30) NOT NULL,
                    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    bank_code VARCHAR(10) NOT NULL ,
                    account_number VARCHAR (15) NOT NULL,
                    beneficiary_name VARCHAR(50) NOT NULL,
                    remark VARCHAR(60) NOT NULL,
                    receipt VARCHAR (255) NOT NULL,
                    time_served TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    fee INT(100) NOT NULL
                    )';
            mysqli_query($conn, $createTableQuery);
        }

        $data = json_decode($json_data);
        $id_from_api = $data->id;
        $amount = $data->amount;
        $status = $data->status;
        $timestamp = $data->timestamp;
        $bank_code = $data->bank_code;
        $account_number = $data->account_number;
        $beneficiary_name = $data->beneficiary_name;
        $remark = $data->remark;
        $receipt = $data->receipt;
        $time_served = $data->time_served;
        $fee = $data->fee;


        //Insert to local database
        $insertQuery = "INSERT INTO disburse (id_from_api, amount, status, timestamp, bank_code, account_number, 
                        beneficiary_name, remark, receipt, time_served, fee) 
                        VALUES ('$id_from_api','$amount', '$status', '$timestamp', '$bank_code', '$account_number',
                                '$beneficiary_name', '$remark', '$receipt', '$time_served', '$fee')";

        if(!$conn->query($insertQuery)) {
            echo "Error when inserting data to table because: " . mysqli_error($conn);
        } else {
            session_start();
            $_SESSION['id'] = $data->id;
            header('Location: ' . CLIENT_URL . '/view/lihat_status.php');
        }

    }

    public function update($data, $query_id)
    {
        $conn = $this->getConnection();

        $id_from_api = $data->id;
        $status = $data->status;
        $receipt = $data->receipt;
        $time_served = $data->time_served;

        mysqli_select_db($conn, DB_NAME);

        //create db
        $query = "SELECT * FROM disburse WHERE id_from_api=" . $id_from_api;
        $checkQuery = $conn->query($query);

        if ($checkQuery->num_rows > 0) {
            //update db
            $updateQuery = "UPDATE disburse SET status='$status', receipt='$receipt',time_served='$time_served' WHERE id_from_api="
                . $id_from_api;

            if (!$conn->query($updateQuery)) {
                echo "Error when updating data to table because: " . mysqli_error($conn);
            } else {

                //display page
                $singleData = $checkQuery->fetch_assoc();
                session_start();
                $_SESSION['success'] = $singleData;
                header('Location: ' . CLIENT_URL . "/view/lihat_status.php");
            }

        } else {
            session_start();
            $_SESSION['error_not_found'] = 'Data dengan id ' . $query_id . ' tidak ditemukan';
            header('Location: ' . CLIENT_URL . "/view/lihat_status.php");
        }
    }
}
?>