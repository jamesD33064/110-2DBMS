<?php
include ("conn.php");
$channelAccessToken = 'es/raPHO4fznLy2Bdt0HKosWCIQu5D8s0nYdpmJfPD08b2D3eAdDTdYFcV9Oe/oh7OAjjDaikNjNo5QxG3StnyR8vEGMuKRPJNHx7qwpeqLCXvSqv0ZGJSrZjslc+MO8RnJTOrHWnghRcBrfhVCiEwdB04t89/1O/w1cDnyilFU=';
$password = '123'; // user login password
$dbFilePath = 'line-db.json'; // user info database file path
if (!file_exists($dbFilePath))
{
    file_put_contents($dbFilePath, json_encode(['user' => []]));
}
$db = json_decode(file_get_contents($dbFilePath) , true);

$bodyMsg = file_get_contents('php://input');

file_put_contents('log.txt', date('Y-m-d H:i:s') . 'Receive: ' . $bodyMsg);

$obj = json_decode($bodyMsg, true);

file_put_contents('log.txt', print_r($db, true));

foreach ($obj['events'] as & $event){
    
    $userId = $event['source']['userId'];
    // bot dirty logic
    
    if (!isset($db['user'][$userId])){
        
        $login_arr = explode(" ", $event['message']['text']);
        
        if ($login_arr[0] === "login"){ //傳來的訊息
        
            $email = $login_arr[1];
            $password = $login_arr[2];
            //登入sql
            $sql = "SELECT * FROM customer";
            $result = mysqli_query($link, $sql);
            $unsign = 1;
            
            if ($result){
                
                if (mysqli_num_rows($result) > 0){
                    
                    while ($row = mysqli_fetch_assoc($result)){
                        
                        if ($row["person_id"] == $email && $row["password"] == $password){
                            
                            $db['user'][$userId] = ['userId' => $userId, 'timestamp' => $event['timestamp'], 'email' => $email, 'password' => $password , 'customer_id' => $row["customer_id"]];
                            file_put_contents($dbFilePath, json_encode($db));
                            $unsign = 0;
                            $message = '登入成功! 用戶: ' . $row['person_id'] ."\n".'可以使用指令: 登出 查詢足跡 疫情總覽';
                            
                        }
                    }
                    if ($unsign){
                        
                        $message = '登入失敗!請檢查帳號或密碼是正確';
                        
                    }
                }
            }
            //sql end
            
        }
        else{
            
            $message = '請登入 格式:login ID PassWord';
            
        }
    }
    else{
        
        if ($event['message']['text'] == '登出'){
            
            unset($db['user'][$userId]);
            file_put_contents($dbFilePath, json_encode($db));
            $message = '登出成功!';
            
        }
        else if ($event['message']['text'] == '查詢足跡'){
            
            $sql = "SELECT p.name , f.time FROM `footprint_data` as f , `place` as p WHERE f.place_id = p.place_id AND f.customer_id = '" . $db['user'][$userId]['customer_id'] . "';";
            $result = mysqli_query($link, $sql);
            $message = "歷史足跡:\n";
            
            try{
                
                if ($result){
                    
                    if (mysqli_num_rows($result) > 0){
                        
                        while ($row = mysqli_fetch_assoc($result)){
                            
                            $message = $message . "----------------------------------------------\n" . $row['time']."\n" .$row['name']."\n";

                        }

                    }
                    
                    mysqli_free_result($result);

                }
            }
            catch(Exception $e){;
            }
            
        }
        else if ($event['message']['text'] == '疫情總覽'){
            
            $sql = "SELECT place.name as name,COUNT(*)as count,max(footprint_data.time)as lasttime FROM place,footprint_data,customer WHERE footprint_data.place_id=place.place_id and footprint_data.customer_id = customer.customer_id AND customer.is_epidemic=1 GROUP by place.place_id;";
            $result = mysqli_query($link, $sql);
            $message = "疫情總覽:\n";
            
            try{
                
                if ($result){
                    
                    if (mysqli_num_rows($result) > 0){
                        
                        while ($row = mysqli_fetch_assoc($result)){
                            
                            $message = $message . "----------------------------------------------\n最後確診者入店時間:\n" . $row['lasttime']."\n\n地點名稱:\n" .$row['name']."\n\n入店確診者人數:\n".$row['count']."\n";

                        }

                    }
                    
                    mysqli_free_result($result);

                }
            }
            catch(Exception $e){;
            }
            
        }
        else{
            
            $message = '可以使用指令: 登出 查詢足跡 疫情總覽';
            
        }
    }

    // Make payload
    $payload = ['replyToken' => $event['replyToken'], 'messages' => [['type' => 'text', 'text' => $message]]];

    // Send reply API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/message/reply');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $channelAccessToken]);
    $result = curl_exec($ch);
    curl_close($ch);

}
?>
