<?php 
$conn=require_once("config.php");

$customer_id=$_POST["customer_id"];
$change_customer=$_POST["change_customer"];

$sql="UPDATE customer SET is_epidemic = '".$change_customer."' WHERE '".$customer_id."'= customer_id;";
$footprint = "SELECT DISTINCT(place_id) FROM footprint_data WHERE customer_id = '".$customer_id."' AND time > DATE_ADD('".$time."', INTERVAL -3 DAY);";
if(mysqli_query($conn,$sql)){
    
}
else{
    echo "該名稱已有人使用!<br>3秒後將自動跳轉頁面<br>";
    echo "<a href='register.html'>未成功跳轉頁面請點擊此</a>";
    exit;
}
        

mysqli_close($conn);

?>