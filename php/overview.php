<?php
    session_start();
    $conn=require_once "config.php";
    $sql = "SELECT place.name as name,COUNT(*)as count,max(footprint_data.time)as lasttime , place. place_id FROM place,`footprint_data`,customer WHERE footprint_data.place_id=place.place_id and footprint_data.customer_id = customer.customer_id AND customer.is_epidemic=1 GROUP by place.place_id;";
    $overview=array();
    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
                $sql_2 = "SELECT * FROM `place` WHERE `place_id` = ".$row['place_id'].";";
                $result_2 = mysqli_query($conn,$sql_2);
                $row_2 = mysqli_fetch_assoc($result_2);
                $tmp = array(
                    "地點名稱" => $row['name'],
                    "確診人次" => (string)$row['count'],
                    "最後確診足跡時間" => $row['lasttime']
                );
            
            
            array_push($overview,$tmp);
        }
        echo json_encode($overview);
        mysqli_free_result($result);
    }
    // echo '</table>';
    mysqli_close($conn);
?>

