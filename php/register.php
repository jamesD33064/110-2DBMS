<?php 
$conn=require_once("config.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $email=$_POST["email"];
    $CorP=$_POST["CorP"];
    if (strpos($username, "'") !== false) {
        echo "INVALID";
        exit;
    }
    if (strpos($password, "'") !== false) {
        echo "INVALID";
        exit;
    }
    //檢查帳號是否重複

    if($CorP == "customer"){//如果是顧客
        $check="SELECT * FROM customer WHERE person_id='".$username."'";
        if(mysqli_num_rows(mysqli_query($conn,$check))==0){
            $sql="INSERT INTO customer (customer_id,person_id, password , email)
                VALUES(NULL,'".$username."','".$password."','".$email."')";
            
            if(mysqli_query($conn, $sql)){
                echo "註冊成功!3秒後將自動跳轉頁面<br>";
                echo "<a href='../view/index.html'>未成功跳轉頁面請點擊此</a>";
                exit;
            }
            else{
                echo $username.$password;
                echo "Error creating table: " . mysqli_error($conn);
            }
        }
        else{
            echo "該帳號已有人使用!<br>3秒後將自動跳轉頁面<br>";
            echo "<a href='register.html'>未成功跳轉頁面請點擊此</a>";
            header('HTTP/1.0 302 Found');
            //header("refresh:3;url=register.html",true);
            exit;
        }
    }
    else{//如果是商家

        $check="SELECT * FROM place WHERE account='".$username."'";
        if(mysqli_num_rows(mysqli_query($conn,$check))==0){
            $sql="INSERT INTO place (name , account , password , is_epidemic , place_id , email)
                VALUES('".$username."','".$username."','".$password."', 0 , NULL,'".$email."')";
            
            if(mysqli_query($conn, $sql)){
                echo "註冊成功!3秒後將自動跳轉頁面<br>";
                echo "<a href='../view/index.html'>未成功跳轉頁面請點擊此</a>";
                exit;
            }
            else{
                echo "Error creating table: " . mysqli_error($conn);
            }
        }
        else{
            echo "該名稱已有人使用!<br>3秒後將自動跳轉頁面<br>";
            echo "<a href='register.html'>未成功跳轉頁面請點擊此</a>";
            header('HTTP/1.0 302 Found');
            //header("refresh:3;url=register.html",true);
            exit;
        }
        
    }
}


mysqli_close($conn);

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='index.php';
    </script>"; 
    
    return false;
} 
?>