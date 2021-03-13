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

        $sql1 = "SELECT user_id FROM 003_omgss_api_tokens WHERE app_id='" . $urlid . "' AND app_token='" . $urltoken . "'";
        $results = mysqli_query($conn, $sql1);
        $rowcount = mysqli_num_rows($results);
        if ($rowcount > 0) {
            $Data = mysqli_fetch_assoc($results);
            $UserId = $Data['user_id'];
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
        $prdid = (isset($_POST['prdid'])) ? runUserInputSanitizationHook($_POST['prdid']) : '';
        $quantity = "1";
        $ip = $_SERVER['REMOTE_ADDR'];


        if (empty($prdid)) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }


        $incrementor = 0;
        $sql = "SELECT * FROM `005_omgss_wishlist` WHERE `ip`='$ip' AND `prdid`='$prdid'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            $incrementor++;

        }
        if ($userid != "") {
            $sql2 = "SELECT * FROM `005_omgss_wishlist` WHERE `userid`='$userid' AND `prdid`='$prdid'";
            $res2 = mysqli_query($conn, $sql2);

            if (mysqli_num_rows($res2) > 0) {
                $incrementor++;
            }
        }


        if ($incrementor > 0) {
            $response = array('status' => 'error', 'message' => 'Product Already Added to Wishlist!!');
            echo json_encode($response);
        } else {

            mysqli_query($conn, "INSERT INTO `005_omgss_wishlist` (`userid`,`ip`,`prdid`,`quantity`) VALUES ('$userid','$ip','$prdid','$quantity')");
            $response = array('status' => 'success', 'message' => 'Product Added to Wishlist!!');
            echo json_encode($response);


        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>