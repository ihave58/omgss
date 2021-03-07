<?php
    include_once('../../include/db.php');


    if (empty($_POST['appid'])) {
        echo $response = json_encode(array('status' => 'error', 'message' => "Appid Can't be Empty"));
        exit;
    }
    if (empty($_POST['token'])) {
        echo $response = json_encode(array('status' => 'error', 'message' => "Token Can't be Empty"));
        exit;
    } else {
        $urlid = $_POST['appid'];
        $urltoken = $_POST['token'];

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
        $loggedinuserid = (isset($_POST['loggedinuserid'])) ? $_POST['loggedinuserid'] : '';


        if (empty($loggedinuserid)) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }

        $incrementor = 0;
        $getresult = "SELECT * FROM 005_omgss_orders WHERE status='Success' AND userid='" . $loggedinuserid . "' ORDER BY `id` DESC";
        $results = mysqli_query($conn, $getresult);
        $count = mysqli_num_rows($results);
        if ($count > 0) {

            $data['status'] = 'success';
            $data['response'] = array();

            $grandtotal = 0;
            while ($row = mysqli_fetch_assoc($results)) {
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
                    $grandtotal = $grandtotal + ($rowprd['saleprice'] * ($itmorderdetails->quantity));
                }

                $taxes = number_format((($grandtotal * 18) / 100), 2);
                if (($coupondetails->coupontype) == 1) {
                    $nettotal = $grandtotal;
                    $totaldiscount = ($nettotal * ($coupondetails->couponamount)) / 100;
                } else if (($coupondetails->coupontype) == 2) {
                    $totaldiscount = $coupondetails->couponamount;
                }

                $incrementor++;
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
                        'taxvalue' => $taxes,
                        'discountvalue' => $totaldiscount,
                        'orderstate' => $row['orderstate'],
                        'razorpayid' => $row['razorpayid'],
                        'couponcode' => $row['couponcode'],
                        'datetime' => $row['datetime']
                    )
                );
                $grandtotal = 0;
            }

            echo json_encode($data, JSON_NUMERIC_CHECK);

        } else {
            $response = array('status' => 'error', 'message' => 'No Orders Found!!');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>