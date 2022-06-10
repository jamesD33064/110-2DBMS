<?php
    session_start();
    ini_set('display_errors','off');
    $conn=require_once "config.php";
    $from=$_REQUEST['from'];
    $to=$_REQUEST['to'];
    // echo $_REQUEST['from'];
    // exit;
    if($_SESSION["CorP"]=="C"){
        if($_REQUEST['from']==''){
            $sql = "SELECT name as 地點名稱,time as 時間,is_epidemic as 是否為疫區 FROM footprint_data f,place p WHERE f.place_id=p.place_id AND f.customer_id=".$_SESSION["id"];
        }
        else{
            // str_replace( "T" , " " , $from , 1 );
            // str_replace( "T" , " " , $to , 1 );
            $sql = "SELECT name as 地點名稱,time as 時間,is_epidemic as 是否為疫區 FROM footprint_data f,place p WHERE f.place_id=p.place_id AND f.time BETWEEN '".$from."' AND '".$to."' AND f.customer_id=".$_SESSION["id"];
        }
    }
    else{
        if($_REQUEST['from']==''){
            $sql = "SELECT c.customer_id as 顧客代號,time as 時間,is_epidemic as 是否為確診者 FROM footprint_data f,customer c WHERE f.customer_id=c.customer_id AND f.place_id=".$_SESSION["id"]." ORDER BY time";
        }
        else{
            // str_replace( "T" , " " , $from , 1 );
            // str_replace( "T" , " " , $to , 1 );
            $sql = $sql = "SELECT c.customer_id as 顧客代號,time as 時間,is_epidemic as 是否為確診者 FROM footprint_data f,customer c WHERE f.customer_id=c.customer_id AND f.time BETWEEN '".$from."' AND '".$to."' AND f.place_id=".$_SESSION["id"]." ORDER BY time";
        }
        
    }
    $footprint_json=array();
    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
            if($_SESSION["CorP"]=="C"){
                $tmp = array(
                    "地點名稱" => $row['地點名稱'],
                    "時間" => (string)$row['時間'],
                    "是否為疫區" => $row['是否為疫區']
                );
            }
            else{
                $tmp = array(
                    "顧客代號" => $row['顧客代號'],
                    "時間" => (string)$row['時間'],
                    "是否為確診者" => (bool)$row['是否為確診者']
                );
            }
            array_push($footprint_json,$tmp);
        }
        echo json_encode($footprint_json);
        mysqli_free_result($result);
    }
    mysqli_close($conn);
?>


