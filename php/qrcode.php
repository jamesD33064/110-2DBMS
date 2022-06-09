<?php
    session_start();
    $conn=require_once "config.php";
    if($_SESSION["CorP"]=="C"){
        $sql = "INSERT INTO `footprint_data` (`place_id`, `time`, `customer_id`, `footprint_id`) VALUES ('{$_REQUEST["place_id"]}', '".date('Y-m-d H:i:s')."', '{$_SESSION["id"]}', NULL);";
        $result = mysqli_query($conn,$sql);
        echo $sql;
        header('location:../view/history.html'); 
    }
    else{
        exit;
    }
    mysqli_close($conn);
?>