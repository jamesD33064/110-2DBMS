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
    
    $sql_customer = "SELECT * FROM customer WHERE person_id ='".$username."'";
    $sql_place = "SELECT * FROM place WHERE account ='".$username."'";
    
    $result_customer=mysqli_query($conn,$sql_customer);
    $result_place=mysqli_query($conn,$sql_place);

    $row_customer=mysqli_fetch_assoc($result_customer);
    $row_place=mysqli_fetch_assoc($result_place);

    if(mysqli_num_rows($result_customer)==1 && $password==$row_customer["password"]){
        session_start();
        // Store data in session variables
        $_SESSION["loggedin"] = true;
        //這些是之後可以用到的變數
        $_SESSION["id"] = $row_customer["customer_id"];
        $_SESSION["username"] = $row_customer["person_id"];
        $_SESSION["CorP"] = "C"; 
        header("location:../view/index.html");
    }
    else if(mysqli_num_rows($result_place)==1 && $password==$row_place["password"]){
        session_start();
        // Store data in session variables
        $_SESSION["loggedin"] = true;
        //這些是之後可以用到的變數
        $_SESSION["id"] = $row_place["place_id"];
        $_SESSION["username"] = $row_place["account"]; 
        $_SESSION["CorP"] = "P"; 
        header("location:../view/index.html");
    }
    else{
        function_alert("帳號或密碼錯誤"); 
        header("location:../view/index.html");
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