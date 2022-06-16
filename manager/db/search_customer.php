<?php
    session_start();
    ini_set('display_errors','off');
    $conn=require_once "config.php";
    $id=$_REQUEST['search_customer'];
    // echo $_REQUEST['from'];
    // exit;
    
    $sql = "SELECT * FROM customer WHERE '".$id."'= customer_id";

    // echo $sql;
    $footprint_json=array();
    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
            $tmp = array(
                "身分證字號" => $row['person_id'],
                "是否確診" => $row['is_epidemic']
            );
            array_push($footprint_json,$tmp);
        }
        echo json_encode($footprint_json);
        mysqli_free_result($result);
    }
    mysqli_close($conn);
?>


