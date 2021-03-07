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
        $ip = $_SERVER['REMOTE_ADDR'];
        $wishid = (isset($_POST['wishid'])) ? runUserInputSanitizationHook($_POST['wishid']) : '';
        $userid = (isset($_POST['userid'])) ? runUserInputSanitizationHook($_POST['userid']) : '';
        $prdid = (isset($_POST['prdid'])) ? runUserInputSanitizationHook($_POST['prdid']) : '';


        if ((empty($wishid)) && (empty($prdid))) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }


        if ($prdid) {
            if ($userid) {
                $sqlfindcart = "SELECT * FROM `005_omgss_wishlist` WHERE `prdid`='$prdid' AND (`ip`='$ip' OR `userid`='$userid')";
            } else {
                $sqlfindcart = "SELECT * FROM `005_omgss_wishlist` WHERE `prdid`='$prdid' AND `ip`='$ip'";
            }
            $resfindcart = mysqli_query($conn, $sqlfindcart);
            if (mysqli_num_rows($resfindcart) > 0) {
                $rowfindcart = mysqli_fetch_assoc($resfindcart);

                $foundcartid = $rowfindcart['id'];

                $sql = "DELETE FROM `005_omgss_wishlist` WHERE `id`='$foundcartid'";
                if ($conn->query($sql) === TRUE) {
                    $response = array('status' => 'success', 'message' => 'Wishlist Item deleted Successfully');
                    echo json_encode($response);
                } else {
                    $response = array('status' => 'error', 'message' => 'Something Went Wrong.!!');
                    echo json_encode($response);
                }
            } else {
                $response = array('status' => 'error', 'message' => 'Product not in Wishlist.');
                echo json_encode($response);
            }


        } else {
            $sqlwish = "SELECT * FROM `005_omgss_wishlist` WHERE `id`='$wishid'";
            $reswish = mysqli_query($conn, $sqlwish);
            if (mysqli_num_rows($reswish) > 0) {
                $rowwish = mysqli_fetch_assoc($reswish);
                if (($rowwish['userid'] == $userid) || (($rowwish['userid'] == "") && ($rowwish['ip'] == $ip))) {
                    $sql = "DELETE FROM `005_omgss_wishlist` WHERE `id`='$wishid'";
                    if ($conn->query($sql) === TRUE) {
                        $response = array('status' => 'success', 'message' => 'Wishlist deleted Successfully');
                        echo json_encode($response);
                    } else {
                        $response = array('status' => 'error', 'message' => 'Something Went Wrong.!!');
                        echo json_encode($response);
                    }
                } else {
                    $response = array('status' => 'error', 'message' => 'You are not authorized to delete this wishlist entry.');
                    echo json_encode($response);
                }
            } else {
                $response = array('status' => 'error', 'message' => 'Invalid Wishlist Entry.');
                echo json_encode($response);
            }
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>