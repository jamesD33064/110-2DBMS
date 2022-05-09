<?php
    session_start();
    $conn=require_once "config.php";
    $sql = "SELECT *  FROM `footprint_data` WHERE `customer_id` = ".$id=$_SESSION["id"].";";
    // echo '<table border="1" width="600" align="center">';
    // echo '<caption><h1>歷史足跡</h1></caption>';
    // echo '<tr bgcolor="#dddddd">';
    // echo '<th>place_id</th><th>TIME</th><th>足跡</th>';
    // echo '</tr>';
    //使用雙層for語句巢狀二維陣列$contact1,以HTML表格的形式輸出
    //使用外層迴圈遍歷陣列$contact1中的行
    $footprint_json=array();
    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
            $sql_2 = "SELECT * FROM `place` WHERE `place_id` = ".$row['place_id'].";";
            $result_2 = mysqli_query($conn,$sql_2);
            $row_2 = mysqli_fetch_assoc($result_2);
            // echo '<td>'.$row_2['name'].'</td>';
            // echo '<td>'.$row['time'].'</td>';
            // if($row_2['is_epidemic']==1){
            //     echo '<td>是</td>';
            // }
            // else{
            //     echo '<td>否</td>';
            // }
            // echo '</tr>';
            $tmp = array(
              "place_name" => $row_2['name'],
              "time" => (string)$row['time'],
              "is_epidemic" => $row_2['is_epidemic']
            );
            array_push($footprint_json,$tmp);
        }
        echo json_encode($footprint_json);
        mysqli_free_result($result);
    }
    // echo '</table>';
    mysqli_close($conn);
?>
