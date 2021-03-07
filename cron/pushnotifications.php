<?php
    include_once('../include/db.php');
    include_once('../include/keys.php');

    for ($i = 1; $i <= 59; $i++) {
        $sql = "SELECT * FROM `005_omgss_usernotifications` WHERE `readstatus`='unread' AND `androidnotification`='No'";
        $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $content = $row['content'];
            $imageget = "http://omgss.in/images/" . $row['image'];
            if ($row['notificationid'] != "system") {
                $getnotiid = $row['notificationid'];
                $sqlnoti = "SELECT * FROM `005_omgss_notifications` WHERE `id`='$getnotiid'";
                $resnoti = mysqli_query($conn, $sqlnoti);
                $rownoti = mysqli_fetch_assoc($resnoti);

                $content = strip_tags($rownoti['description']);
                $imageget = "http://omgss.in/admin/files/noti/" . $rownoti['image'];
            }
            $getuserid = $row['userid'];
            $sqlgettheuser = "SELECT * FROM `005_omgss_users` WHERE `id`='$getuserid'";
            $resgettheuser = mysqli_query($conn, $sqlgettheuser);
            $rowgettheuser = mysqli_fetch_assoc($resgettheuser);

            $url = "https://fcm.googleapis.com/fcm/send";
            $token = $rowgettheuser['devicetoken'];

            $title = "Update";
            $body = $content;
            $image = $imageget;
            $notification = array('title' => $title, 'text' => $body, 'image' => $image);
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
            $getnotiid = $row['id'];
            mysqli_query($conn, "UPDATE `005_omgss_usernotifications` SET `androidnotification`='Yes' WHERE `id`='$getnotiid'");
        }

        sleep(1);
    }

?>