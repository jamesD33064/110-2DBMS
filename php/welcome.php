<?php
session_start();  //很重要，可以用的變數存在session裡
if($_SESSION["loggedin"]==true){
    $username=$_SESSION["username"];
    $id=$_SESSION["id"];
    echo "<h1>你好 ".$username."</h1>";
    echo "<h1>你好 ".$id."</h1>";
    echo "<a href='./logout.php'>登出</a>";
}
else{
        function_alert("Something wrong"); 
    }

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='index.php';
    </script>"; 
    return false;
} 
?>