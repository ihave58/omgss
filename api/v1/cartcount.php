<?php
    include_once('../../include/db.php');
    require("../../include/utils.php");

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

        $userid = (isset($_POST['userid'])) ? runUserInputSanitizationHook($_POST['userid']) : '';

        $ip = $_SERVER['REMOTE_ADDR'];


        if ($userid) {
            $sql = "SELECT * FROM `005_omgss_cart` WHERE `userid`='$userid' OR `ip`='$ip'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
        } else {
            $sql = "SELECT * FROM `005_omgss_cart` WHERE `ip`='$ip'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
        }


        if ($count > 0) {
            $response = array('status' => 'success', 'countofcart' => $count);
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'message' => 'No Cart Items');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>