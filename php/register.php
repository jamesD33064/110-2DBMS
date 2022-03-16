<?php
    $dbname="fcu";

    $link = mysqli_connect("localhost" , $dbname , "A123456789" , $dbname) 
            or die("fault");
    echo "successful<br>";
    
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];

    $sql = " SELECT * FROM `student`; ";

    $check="SELECT * FROM student WHERE id='".$username."'";

    if(mysqli_num_rows(mysqli_query($link,$check))==0){
        $sql = "INSERT INTO student (id, password)
                VALUES('".$username."','".$password."')";
        if(mysqli_query($link, $sql)){
            echo "註冊成功!3秒後將自動跳轉頁面<br>";
            echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
            // header("refresh:32;url=index.php");
            exit;
        }
    }
    else{
        echo "該帳號已有人使用!<br>3秒後將自動跳轉頁面<br>";
        echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
        // header('HTTP/1.0 302 Found');
        //header("refresh:3;url=register.html",true);
        exit;
    }

    mysqli_close($link);

    
    // $password_hash=password_hash($password,PASSWORD_DEFAULT);
    



?>

