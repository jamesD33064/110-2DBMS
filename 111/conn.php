<?php
    
    $dbuser="root";
    $password="";
    $dbname="ncnuiot";


    $link = mysqli_connect("localhost" , $dbuser ,  $password , $dbname) or die("還沒連上資料庫喔：Ｄ");
    // echo "successful<br>";
?>