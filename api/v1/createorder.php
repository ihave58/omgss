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
        $orderdetails = (isset($_POST['orderdetails'])) ? runUserInputSanitizationHook($_POST['orderdetails']) : '';
        $fullname = (isset($_POST['fullname'])) ? runUserInputSanitizationHook($_POST['fullname']) : '';
        $email = (isset($_POST['email'])) ? runUserInputSanitizationHook($_POST['email']) : '';
        $address = (isset($_POST['address'])) ? runUserInputSanitizationHook($_POST['address']) : '';
        $city = (isset($_POST['city'])) ? runUserInputSanitizationHook($_POST['city']) : '';
        $state = (isset($_POST['state'])) ? runUserInputSanitizationHook($_POST['state']) : '';
        $zip = (isset($_POST['zip'])) ? runUserInputSanitizationHook($_POST['zip']) : '';
        $paymenttype = (isset($_POST['paymenttype'])) ? runUserInputSanitizationHook($_POST['paymenttype']) : '';
        $totalordervalue = (isset($_POST['totalordervalue'])) ? runUserInputSanitizationHook($_POST['totalordervalue']) : '';
        $discount = (isset($_POST['discount'])) ? runUserInputSanitizationHook($_POST['discount']) : '';
        $status = "Success";

        $razorpayid = (isset($_POST['razorpayid'])) ? runUserInputSanitizationHook($_POST['razorpayid']) : '';
        $couponcode = (isset($_POST['couponcode'])) ? runUserInputSanitizationHook($_POST['couponcode']) : '';
        $coupondetails = (isset($_POST['coupondetails'])) ? runUserInputSanitizationHook($_POST['coupondetails']) : '';
        $dateind = date("Y-m-d") . " " . date("h:i:sa");
        $ip = $_SERVER['REMOTE_ADDR'];


        if ((empty($userid)) || (empty($orderdetails)) || (empty($fullname)) || (empty($email)) || (empty($address)) || (empty($paymenttype)) || (empty($totalordervalue))) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }

        $sqlcreate = "INSERT INTO `005_omgss_orders` (`userid`,`orderdetails`,`fullname`,`email`,`address`,`city`,`state`,`zip`,`paymenttype`,`totalordervalue`,`status`,`couponcode`,`coupondetails`,`datetimeind`,`razorpayid`) VALUES ('$userid','$orderdetails','$fullname','$email','$address','$city','$state','$zip','$paymenttype','$totalordervalue','$status','$couponcode','$coupondetails','$dateind','$razorpayid')";


        if ($conn->query($sqlcreate) === TRUE) {
            $lastid = mysqli_insert_id($conn);
            mysqli_query($conn, "DELETE FROM `005_omgss_cart` WHERE `ip`='$ip' OR `userid`='$userid'");
            $messnoti = "Your Order OMGORD" . $lastid . " has been received by us";
            mysqli_query($conn, "INSERT INTO `005_omgss_usernotifications`(`userid`,`image`,`content`)VALUES('$userid','pass.png','$messnoti')");


            $getresult = "SELECT * FROM `005_omgss_orders` WHERE `id`='$lastid'";
            $results = $conn->query($getresult);
            $count = mysqli_num_rows($results);
            if ($count > 0) {
                $data['status'] = 'success';
                $counter = 0;
                $data['response'] = array();
                while ($row = $results->fetch_assoc()) {
                    $counter++;
                    $orderdetails = json_decode($row['orderdetails']);
                    $coupondetails = json_decode($row['coupondetails']);
                    $dataorderdetails = array();
                    foreach ($orderdetails as $itmorderdetails) {
                        $prdid = $itmorderdetails->productid;
                        $sqlprd = "SELECT * FROM `005_omgss_products` WHERE `id`='$prdid'";
                        $resprd = mysqli_query($conn, $sqlprd);
                        $rowprd = mysqli_fetch_assoc($resprd);
                        array_push($dataorderdetails, array(
                            'productid' => $prdid,
                            'productname' => $rowprd['name'],
                            'productimg' => "http://omgss.in/admin/files/prod/" . $rowprd['image'],
                            'thumbnail' => "http://omgss.in/admin/files/thumbnails/" . $rowprd['thumbnail'],
                            'saleprice' => $rowprd['saleprice'],
                            'quantity' => $itmorderdetails->quantity
                        ));

                    }
                    array_push($data['response'], array(
                            'id' => $row['id'],
                            'orderdetails' => $dataorderdetails,
                            'fullname' => $row['fullname'],
                            'email' => $row['email'],
                            'address' => $row['address'],
                            'city' => $row['city'],
                            'state' => $row['state'],
                            'zip' => $row['zip'],
                            'paymenttype' => $row['paymenttype'],
                            'totalordervalue' => $row['totalordervalue'],
                            'discount' => $row['discount'],
                            'status' => $row['status'],
                            'orderstate' => $row['orderstate'],
                            'razorpayid' => $row['razorpayid'],
                            'couponcode' => $row['couponcode'],
                            'coupondetails' => $coupondetails,
                            'datetimeind' => $row['datetimeind']


                        )


                    );
                }


                echo json_encode($data, JSON_NUMERIC_CHECK);

            } else {
                $response = array('status' => 'error', 'message' => 'No Address Found.!!');
                echo json_encode($response);
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Something went Wrong, Order Not Created.!!');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>