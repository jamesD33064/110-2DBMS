<?php
    include ("./config.php");
    include ("./SendMail/SMTP.php");

    $person_diagnose_id = $_POST[];
    $time = $_POST[];
    $sql = "SELECT DISTINCT(customer_id) FROM footprint_data WHERE customer_id <> '".$person_diagnose_id."' AND time > DATE_ADD('".$time."', INTERVAL -3 DAY);";

    
    
?>