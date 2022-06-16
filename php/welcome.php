<?php
ini_set('display_errors','off');
session_start();  //很重要，可以用的變數存在session裡
if($_SESSION["loggedin"]==true){
    $username=$_SESSION["username"];
    $id=$_SESSION["id"];
    echo $username;
}
else{
    // function_alert("Something wrong"); 
    echo "";
}
function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='../view/index.html';
    </script>"; 
    return false;
} 
?>