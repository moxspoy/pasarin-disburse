<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 13:53
 * Github       : https://github.com/moxspoy
 */

include_once 'api/config/database.php';

echo "Creating database ...";

$db = new Database();
$conn = $db->getConnection();

$createDatabaseQuery = 'CREATE DATABASE pasarin_disburse';
if($conn->query($createDatabaseQuery)) {
    echo "Database created successfully. You now can open index.php on root folder";
} else {
    echo "Error creating database: " . $conn->error;
}

