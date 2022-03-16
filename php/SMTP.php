<?php
$from = "hueyan@ms2.hinet.net";
mb_internal_encoding("utf-8");
$to="james0120160379@gmail.com";
$subject=mb_encode_mimeheader("PHP自動發信","utf-8");
$message="中文也不會有問題了喔";
// $headers="MIME-Version: 1.0\n";
// $headers.="Content-type: text/html; charset=utf-8\n";
$headers="From: $from\nReply-To:$from\n";
if(mail($to,$subject,$message,$headers)){
    echo successful ;
}
else{
    echo 0;
}

?>