<?php 
$conn=require_once("config.php");

$place_id=$_POST["place_id"];
$change_place=$_POST["change_place"];

$sql="UPDATE place SET is_epidemic = '".$change_place."' WHERE '".$place_id."'=place_id;";
echo $sql;
if(mysqli_query($conn,$sql)){
    echo "Success";
}
else{
    echo "該名稱已有人使用!<br>3秒後將自動跳轉頁面<br>";
    echo "<a href='register.html'>未成功跳轉頁面請點擊此</a>";
    exit;
}
        

mysqli_close($conn);

?>