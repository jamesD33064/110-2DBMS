<?php
    session_start();
    $place_id=$_SESSION["id"];
    $urlToEncode="https://mspredator.com/110-2Cloud/php/qrcode.php?place_id=".$place_id; 
    generateQRfromGoogle($urlToEncode);
    
    function generateQRfromGoogle($chl,$widhtHeight ='150',$EC_level='L',$margin='0'){ 
        $chl = urlencode($chl); 
        echo '<img src="http://chart.apis.google.com/chart?chs='.$widhtHeight.'x'.$widhtHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.'&chl='.$chl.'" alt="QR code" widhtHeight="'.$widhtHeight.'" widhtHeight="'.$widhtHeight.'"/>'; 
    } 
?>