<?php
    session_start();
    $username="";
    $password="";
    $dbname="1102DBMS";

    $link = mysqli_connect("localhost" , $dbname , "123" , $dbname) 
            or die("fault");
        
    echo "successful<br>";
    
    $id=$_POST["id"];
    $password=$_POST["password"];

    $sql = " SELECT * FROM `顧客`; ";

    if($result = mysqli_query($link,$sql)){
        while($row = mysqli_fetch_assoc($result)){

            $hash = password_hash($row["密碼"], PASSWORD_DEFAULT);

            if($row["身分證字號"]==$id && password_verify($password, $hash)){
                echo "登入成功".$row["身分證字號"]."-".$row["密碼"]."<br>";
                $_SESSION['id'] = $id;
                // header("Location: index.php"); 
                // header("refresh:32;url=index.html");
                exit;
            }
        }
        echo "登入失敗";
        mysqli_free_result($result);
    }
    mysqli_close($link);

    
    // $password_hash=password_hash($password,PASSWORD_DEFAULT);
    



?>

