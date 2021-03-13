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
        $couponcode = (isset($_POST['couponcode'])) ? runUserInputSanitizationHook($_POST['couponcode']) : '';


        if ((empty($userid)) || (empty($couponcode))) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }


        $sqlchkcoup = "SELECT * FROM `005_omgss_coupons` WHERE `couponcode`='$couponcode'";
        $reschkcoup = mysqli_query($conn, $sqlchkcoup);
        if (mysqli_num_rows($reschkcoup) > 0) {
            $rowchkcoup = mysqli_fetch_assoc($reschkcoup);

            $couponid = $rowchkcoup['id'];
            $couponname = $rowchkcoup['couponname'];
            $couponcode = $rowchkcoup['couponcode'];
            $coupontype = $rowchkcoup['coupontype'];
            $couponamount = $rowchkcoup['couponamount'];
            $usageperuser = $rowchkcoup['usageperuser'];


            $sqlchkusercoup = "SELECT * FROM `005_omgss_orders` WHERE `userid`='$userid' AND `couponcode`='$couponid'";
            $reschkusercoup = mysqli_query($conn, $sqlchkusercoup);
            $countusersappliedcoup = mysqli_num_rows($reschkusercoup);

            if ($countusersappliedcoup < $usageperuser) {
                $data['status'] = 'success';
                $data['response'] = array();
                if ($coupontype == 1) {

                    array_push($data['response'], array(
                            'id' => $couponid,
                            'couponname' => $couponname,
                            'couponcode' => $couponcode,
                            'coupontype' => $coupontype,
                            'couponamount' => $couponamount,
                            'usageperuser' => $usageperuser


                        )


                    );

                } else if ($coupontype == 2) {
                    array_push($data['response'], array(
                            'id' => $couponid,
                            'couponname' => $couponname,
                            'couponcode' => $couponcode,
                            'coupontype' => $coupontype,
                            'couponamount' => $couponamount,
                            'usageperuser' => $usageperuser


                        )


                    );
                }
                echo json_encode($data, JSON_NUMERIC_CHECK);
            } else {
                $response = array('status' => 'error', 'message' => 'You have utilized the maximum redemtion of this coupon, please select another coupon !!!');
                echo json_encode($response);
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Invalid Coupon.!!');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>