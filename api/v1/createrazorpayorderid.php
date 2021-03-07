<?php
    include_once('../../include/db.php');
    require("../../include/utils.php");
    require('../../razorpay/config.php');
    require('../../razorpay/razorpay-php/Razorpay.php');

    if (empty($_POST['appid'])) {
        echo $response = json_encode(array('status' => 'error', 'message' => "Appid Can't be Empty"));
        exit;
    }
    if (empty($_POST['token'])) {
        echo $response = json_encode(array('status' => 'error', 'message' => "Token Can't be Empty"));
        exit;
    } else {
        $urlid = runUserInputSanitizationHook($_POST['appid']);
        $urltoken = runUserInputSanitizationHook($_POST['token']);

        $sql1 = "SELECT id FROM 003_omgss_api_tokens WHERE app_id='" . $urlid . "' AND app_token='" . $urltoken . "'";
        $results = mysqli_query($conn, $sql1);
        $rowcount = mysqli_num_rows($results);
        if ($rowcount > 0) {
            $Data = mysqli_fetch_assoc($results);
            $UserId = $Data['id'];
        }

    }

    if (empty($UserId)) {
        $response = array('status' => 'error', 'message' => 'Invalid appid or token');
        echo json_encode($response);
        exit;
    }

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'POST') {

        $amount = (isset($_POST['amount'])) ? runUserInputSanitizationHook($_POST['amount']) : '';


        if ((empty($amount))) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }


        $login = $keyId;
        $password = $keySecret;
        $url = 'https://api.razorpay.com/v1/orders';
        $fstr1 = "amount";
        $sstr1 = $amount * 100;
        $fstr2 = "currency";
        $sstr2 = "INR";
        $fstr3 = "receipt";
        $sstr3 = "rcptid #1";
        $fstr4 = "payment_capture";
        $sstr4 = "1";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array($fstr1 => $sstr1, $fstr2 => $sstr2, $fstr3 => $sstr3, $fstr4 => $sstr4)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
        $response = curl_exec($ch);
        $result = json_decode($response);
        curl_close($ch);
        /*echo '<pre>';
        print_r($result);
        echo '</pre>';*/

        $orderidrazor = $result->id;

        $response = array('status' => 'success', 'razorpayorderid' => $orderidrazor);
        echo json_encode($response);


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>