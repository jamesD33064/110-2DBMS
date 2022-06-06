<?php 
 
//設定Token 
$ChannelSecret = '9089268ac1cdd4e1757b9cdd303ac569'; 
$ChannelAccessToken = 'es/raPHO4fznLy2Bdt0HKosWCIQu5D8s0nYdpmJfPD08b2D3eAdDTdYFcV9Oe/oh7OAjjDaikNjNo5QxG3StnyR8vEGMuKRPJNHx7qwpeqLCXvSqv0ZGJSrZjslc+MO8RnJTOrHWnghRcBrfhVCiEwdB04t89/1O/w1cDnyilFU='; 
 
//讀取資訊 
$HttpRequestBody = file_get_contents('php://input'); 
$HeaderSignature = $_SERVER['HTTP_X_LINE_SIGNATURE']; 
 
//驗證來源是否是LINE官方伺服器 
$Hash = hash_hmac('sha256', $HttpRequestBody, $ChannelSecret, true); 
$HashSignature = base64_encode($Hash); 
if($HashSignature != $HeaderSignature) 
{ 
    die('hash error!'); 
} 
$db = json_decode(file_get_contents($dbFilePath) , true);

$bodyMsg = file_get_contents('php://input');

file_put_contents('log.txt', date('Y-m-d H:i:s') . 'Receive: ' . $bodyMsg);

$obj = json_decode($bodyMsg, true);

file_put_contents('log.txt', print_r($db, true));

foreach ($obj['events'] as & $event)
{
    $userId = $event['source']['userId'];
    // bot dirty logic
    if (!isset($db['user'][$userId]))
    {
        $login_arr = explode(" ", $event['message']['text']);
        if ($login_arr[0] === "login")
        { //傳來的訊息
            $email = $login_arr[1];
            $password = $login_arr[2];
            //登入sql
            $sql = "SELECT * FROM customer";
            $result = mysqli_query($link, $sql);
            $unsign = 1;
            if ($result)
            {
                if (mysqli_num_rows($result) > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        if ($row["email"] == $email && $row["user_password"] == $password)
                        {
                            $db['user'][$userId] = ['userId' => $userId, 'timestamp' => $event['timestamp'], 'email' => $email, 'password' => $password];
                            file_put_contents($dbFilePath, json_encode($db));
                            $unsign = 0;
                            $message = '登入成功! 用戶: ' . $row['username'];
                        }
                    }
                    if ($unsign)
                    {
                        $message = '登入失敗!請檢查帳號或密碼是正確';
                    }
                }
            }
            //sql end
            
        }
        else
        {
            $message = '請登入 格式:login email password';
        }
    }
    else
    {
        if ($event['message']['text'] == '登出')
        {
            unset($db['user'][$userId]);
            file_put_contents($dbFilePath, json_encode($db));
            $message = '登出成功!';
        }
        else if ($event['message']['text'] == '查詢訂單')
        {
            $sql = "SELECT * FROM test WHERE id= '" . $db['user'][$userId]['email'] . "';";
            $result = mysqli_query($link, $sql);
            $message = "訂單:\n";
            try
            {
                if ($result)
                {
                    if (mysqli_num_rows($result) > 0)
                    {
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            if ($row["id"] == $db['user'][$userId]['email'])
                            {
                                $message = $message . "----------------------------------------------\n" . $row['sell_date'] . "\n";
                                $product = json_decode($row['product_num_json'], true);
                                for ($i = 0;$i < count($product);$i++)
                                {
                                    $message = $message . $product[$i]['name'] . "x" . $product[$i]['count'] . "\n";
                                }
                            }

                        }

                    }
                    mysqli_free_result($result);

                }
            }
            catch(Exception $e)
            {;
            }
        }
        else
        {
            $message = '可以使用指令: 登出 查詢訂單';
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