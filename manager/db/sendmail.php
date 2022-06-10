<?php
    include ("./config.php");
    include ("./SendMail/SMTP.php");
    $sql = "SELECT place.name as name,COUNT(*)as count,max(footprint_data.time)as lasttime , place. place_id FROM place,`footprint_data`,customer WHERE footprint_data.place_id=place.place_id and footprint_data.customer_id = customer.customer_id AND customer.is_epidemic=1 GROUP by place.place_id;";

    // $sql = "SELECT FROM WHERE"
    

?>