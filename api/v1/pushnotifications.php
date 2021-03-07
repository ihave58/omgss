<?php
    $url = "https://fcm.googleapis.com/fcm/send";
    $token = "chNqzKnOQZ2JkaEa9ucMDs:APA91bHoFCCDENGVrpCvFJ08OLKxaHNr1Qr1fkKo1NYwSxtfZ9iOv3DHODAVe31XvDxf7MnHkR1K9NErV2BcTzH4y004XLpGRnj4Vf-JJkByCzMIKF4Jb6zvNQH_Ampe6IJiIzv5bPOP";
    $serverKey = 'AAAAeF-uCmU:APA91bGwvH193mEJQb6ZPODCTkn73U_yUHMLVHBtxwOV1Az2fX1CLcAB_nCbDma0kxPTC_5barm_lQtrXUgP48GeGz6NWWpAStz4U7JeaqHxFmQdytQp2o8UQYl7Q-M-93fwHzSMrDDZ';
    $title = "Title";
    $body = "Body of the message";
    $notification = array('title' => $title, 'text' => $body);
    $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority' => 'high');
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key=' . $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,

        "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//Send the request
    $response = curl_exec($ch);
//Close request
    if ($response === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
?>