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
        $opass = (isset($_POST['opass'])) ? runUserInputSanitizationHook($_POST['opass']) : '';
        $npass = (isset($_POST['npass'])) ? runUserInputSanitizationHook($_POST['npass']) : '';
        $cpass = (isset($_POST['cpass'])) ? runUserInputSanitizationHook($_POST['cpass']) : '';


        if ((empty($opass)) || (empty($npass)) || (empty($cpass)) || (empty($userid))) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }

        $opass = md5($_POST['opass']);
        $npass = md5($_POST['npass']);
        $cpass = md5($_POST['cpass']);

        if ($npass != $cpass) {

            $response = array('status' => 'error', 'message' => 'Passwords Donot Match!');
            echo json_encode($response);
            exit;
        } else {

            $sqllog1 = "SELECT * FROM `005_omgss_users` WHERE `id`='$userid'";
            $reslog1 = mysqli_query($conn, $sqllog1);
            $countlog1 = mysqli_num_rows($reslog1);
            if ($countlog1 > 0) {
                $rowlog1 = mysqli_fetch_assoc($reslog1);
                $odpass = $rowlog1['pass'];
                if ($opass != $odpass) {

                    $response = array('status' => 'error', 'message' => 'Wrong Password!');
                    echo json_encode($response);
                    exit;
                } else {
                    $sqldel = "UPDATE `005_omgss_users` SET `pass`='$npass' WHERE `id`='$userid'";
                    if ($conn->query($sqldel) === TRUE) {

                        $response = array('status' => 'success', 'message' => 'Password Changed Successfully!');
                        echo json_encode($response);
                    } else {
                        $response = array('status' => 'error', 'message' => 'Something Went Wrong!');
                        echo json_encode($response);
                        exit;
                    }
                }
            } else {
                $response = array('status' => 'error', 'message' => 'No User Found.!!');
                echo json_encode($response);
            }


        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>