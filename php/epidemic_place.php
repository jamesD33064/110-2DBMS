<?php
    session_start();
    $conn=require_once "config.php";
    $sql = "SELECT 'name'  FROM `place` WHERE `is_epidemic` = '1';";

    $footprint_json=array();
    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){

            // $sql_3 = "SELECT COUNT(is_epidemic) FROM customer WHERE place_id='張一';" ;
            // $result_3 = mysqli_query($conn,$sql_3);
            // $row_3 = mysqli_fetch_assoc($result_3);
            $tmp = array(
                "地點名稱" => $row['name']
                // "確診者造訪人數" => (bool)$row_3['is_epidemic']
            );
            
            array_push($footprint_json,$tmp);
            
        }
        echo json_encode($footprint_json);
        mysqli_free_result($result);
    }
    // echo '</table>';
    mysqli_close($conn);
?>

