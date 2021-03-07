<?php
    function sendPushNotification($to = '', $data = array())
    {
        $apiKey = 'c4b339a2e96bf27c';
        $fields = array('to' => $to, 'notification' => $data);

        $headers = array('Authorization:key=' . $apiKey, 'Content-Type:application/Json');

        $url = 'https://fcm.googleapis.com/fcm/send';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $results = curl_exec($ch);
        curl_close($ch);
        return json_decode($results, true);
    }

    $to = "fP-xHAv5QsmtNU7f8XQ--s:APA91bGKe9qHxV9nwIhAl2QKwme7fQW4U2gzFLyA_pcpNY1qoC2SCsmBvt6EBS7zFN0nuXLwhz22ZKitg00nM4J_fQTuhfCcYfchg0V0LweEqXJDcOJIRMFqhx-Ggmws_vHLNYpbcNyw";
    $data = array(
        'body' => 'New message'
    );
    print_r(sendPushNotification($to, $data));
?>