<?php
ini_set('display_errors','off');
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
    $sql = "INSERT INTO taiwan_covid19(time,diagnosenumber) VALUES ('".$row['a01']."',".$row['a06'].")";
    try{
        mysqli_query($conn,$sql);
    }
    catch(Exception $e){

    }
}
if($_REQUEST['type']=="week"){
    $sql = "SELECT time,diagnosenumber,avg(diagnosenumber) OVER (ORDER BY `time` ROWS BETWEEN 6 PRECEDING AND 0 FOLLOWING) AS aver FROM `taiwan_covid19` order by `time` DESC ;";
    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
            $tmp = array(
                "通報日" => $row['time'],
                "新增確診" => $row['diagnosenumber'],
                "七日確診人數平均" => $row['aver']
            );
            array_push($json,$tmp);
        }
    }
}
else{
    $sql = "SELECT time,diagnosenumber,avg(diagnosenumber) OVER (ORDER BY `time` ROWS BETWEEN 29 PRECEDING AND 0 FOLLOWING) AS aver FROM `taiwan_covid19` order by `time` DESC;";
    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
            $tmp = array(
                "通報日" => $row['time'],
                "新增確診" => $row['diagnosenumber'],
                "三十日確診人數平均" => $row['aver']
            );
            array_push($json,$tmp);
        }
    }
}
echo json_encode($json);
?>