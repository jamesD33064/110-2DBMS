<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u558221944_DBMSuser');
define('DB_PASSWORD', 'Waxdqzces123!');
define('DB_NAME', 'u558221944_DBMS');

//$link = mysqli_connect(DB_SERVER, "root", "", DB_NAME);
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else{
    return $link;
}
?>