<?php 
$conn=require_once("config.php");
include "./SendMail/SMTP.php";
$customer_id=$_REQUEST["customer_id"];
$change_customer=$_REQUEST["change_customer"];

$sql="UPDATE customer SET is_epidemic = '".$change_customer."' WHERE '".$customer_id."'= customer_id;";
if(mysqli_query($conn,$sql)){
    if($change_customer!=0){
        $footprint_update_sql = "UPDATE place SET is_epidemic = 1 WHERE place_id in (SELECT DISTINCT(place_id) FROM footprint_data WHERE customer_id = '".$customer_id."' AND time > DATE_ADD(now(), INTERVAL -3 DAY))";
        $footprint_sql = "SELECT * from customer where customer_id in (SELECT DISTINCT(customer_id) FROM footprint_data WHERE place_id in(SELECT DISTINCT(place_id) FROM footprint_data WHERE customer_id = '".$customer_id."' AND time > DATE_ADD(now(), INTERVAL -3 DAY)) AND time > DATE_ADD(now(), INTERVAL -3 DAY) AND customer_id <> '".$customer_id."')";
        $sql3="SELECT DISTINCT customer_id,time,p.name FROM footprint_data f,place p WHERE f.place_id in(SELECT DISTINCT(place_id) FROM footprint_data WHERE customer_id = '".$customer_id."' AND time > DATE_ADD(now(), INTERVAL -3 DAY)) AND time > DATE_ADD(now(), INTERVAL -3 DAY) AND customer_id <> '".$customer_id."' AND f.place_id=p.place_id";
        $result_inner = mysqli_query($conn,$sql3);
        //用誰取得三天內造訪的地點誰去過
        mysqli_query($conn,$footprint_update_sql);
        //echo $footprint_sql;
        if($result = mysqli_query($conn,$footprint_sql)){
            while($row = mysqli_fetch_assoc($result)){
                echo "用戶".$row['person_id']."三天內有相同足跡<br>";
                
                //echo $sql3;
                //用誰取得三天內造訪的地點的時間
                $row_inner = mysqli_fetch_assoc($result_inner);
                //echo $row_inner;
                smtp($row['email'] , $row['person_id'] , "疫情接觸通知" , make_mail($row['person_id'],$row_inner['time'],$row_inner['name']));
                echo "<br>";
            }
        }
    }
}
else{
    echo "FAIL";
    exit;
}

// SELECT DISTINCT(place_id) FROM footprint_data WHERE customer_id = '".$customer_id."' AND time > DATE_ADD('".$time."', INTERVAL -3 DAY)

        

mysqli_close($conn);

function make_mail($person_id_mail , $time_mail, $where_mail){
                ob_start();
                include './SendMail/mail_template.html';
                $mail_body = ob_get_clean();
                $mail_body = str_replace("person_id",$person_id_mail , $mail_body);
                $mail_body = str_replace("time", $time_mail , $mail_body);
                $mail_body = str_replace("where", $where_mail , $mail_body);
                return $mail_body;
        }

?>