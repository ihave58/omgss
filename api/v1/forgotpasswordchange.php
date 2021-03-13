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
        $useridft = (isset($_POST['useridft'])) ? runUserInputSanitizationHook($_POST['useridft']) : '';
        $npass = (isset($_POST['npass'])) ? runUserInputSanitizationHook($_POST['npass']) : '';
        $cpass = (isset($_POST['cpass'])) ? runUserInputSanitizationHook($_POST['cpass']) : '';


        if (empty($useridft) || empty($npass) || empty($cpass)) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }

        $sqluser = "SELECT * FROM `005_omgss_users` WHERE `id`='$useridft'";
        $resuser = mysqli_query($conn, $sqluser);
        if (mysqli_num_rows($resuser) > 0) {

        } else {
            $response = array('status' => 'error', 'message' => 'No Such User.');
            echo json_encode($response);
            exit;
        }

        if ($npass != $cpass) {
            $response = array('status' => 'error', 'message' => 'New Password and Confirm Passwords donot match.');
            echo json_encode($response);
            exit;
        } else {
            $passwordmh5 = md5($npass);
            $sql = "UPDATE `005_omgss_users` SET `pass`='$passwordmh5' WHERE `id`='$useridft'";
            $res = mysqli_query($conn, $sql);
            $response = array('status' => 'success', 'message' => 'Password Changed Successfully.');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>