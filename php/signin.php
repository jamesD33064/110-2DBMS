<?php
// Include config file
$conn=require_once "config.php";
 
// Define variables and initialize with empty values
$username=$_POST["username"];
$password=$_POST["password"];
//增加hash可以提高安全性
$password_hash=password_hash($password,PASSWORD_DEFAULT);
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "SELECT * FROM customer WHERE person_id ='".$username."'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)==1 && $password==$row["password"]){
        session_start();
        // Store data in session variables
        $_SESSION["loggedin"] = true;
        //這些是之後可以用到的變數
        $_SESSION["id"] = $row["customer_id"];
        $_SESSION["username"] = $row["person_id"]; 
        header("location:../view/index.html");
    }else{
            function_alert("帳號或密碼錯誤"); 
        }
}
    else{
        function_alert("Something wrong"); 
    }

    // Close connection
    mysqli_close($link);

function function_alert($message) { 
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='index.php';
    </script>"; 
    return false;
} 
?>