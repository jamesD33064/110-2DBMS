<?php
$handle = fopen("https://covid-19.nchc.org.tw/api/covid19?CK=covid-19@nchc.org.tw&querydata=4048","rb");
$content = "";
while (!feof($handle)) {
    $content .= fread($handle, 10000);
}
fclose($handle);
$content = json_decode($content,true);
$json=array();

//insert to db
$conn=require_once "config.php";

    
foreach($content as $row)
{
    $tmp = array(
        "通報日" => $row['a01'],
        "新增確診" => $row['a06'],
        "七日確診人數平均" => $row['a07']
    );
    $sql = "INSERT INTO taiwan_covid19(time,diagnosenumber) VALUES ('".$row['a01']."',".$row['a06'].")";
    mysqli_query($conn,$sql);
    array_push($json,$tmp);
}
echo json_encode($json);
?>