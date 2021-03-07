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
        $userid = (isset($_POST['userid'])) ? $_POST['userid'] : '';
        $ip = $_SERVER['REMOTE_ADDR'];


        if ($userid) {
            $sqlcountallcart = "SELECT * FROM `005_omgss_wishlist` WHERE `ip`='$ip' OR `userid`='$userid'";
        } else {
            $sqlcountallcart = "SELECT * FROM `005_omgss_wishlist` WHERE `ip`='$ip'";
        }
        $rescountallcart = mysqli_query($conn, $sqlcountallcart);
        $countallcart = mysqli_num_rows($rescountallcart);


        $incrementor = 0;
        $subtotal = 0;
        if ($countallcart > 0) {

            $data['status'] = 'success';
            $data['orderdetails'] = array();
            while ($row = mysqli_fetch_assoc($rescountallcart)) {
                $incrementor++;
                $prdid = $row['prdid'];
                $sqlprd = "SELECT * FROM `005_omgss_products` WHERE `id`='$prdid'";
                $resprd = mysqli_query($conn, $sqlprd);
                $rowprd = mysqli_fetch_assoc($resprd);

                if ($userid) {
                    $sqlcheckincart = "SELECT * FROM `005_omgss_cart` WHERE (`ip`='$ip' OR `userid`='$userid') AND `prdid`='$prdid'";
                } else {
                    $sqlcheckincart = "SELECT * FROM `005_omgss_cart` WHERE `ip`='$ip' AND `prdid`='$prdid'";
                }
                $rescheckincart = mysqli_query($conn, $sqlcheckincart);
                if (mysqli_num_rows($rescheckincart) > 0) {
                    $isAddedToCart = 1;
                } else {
                    $isAddedToCart = 0;
                }

                array_push($data['orderdetails'], array(
                        'id' => $row['id'],
                        'prdid' => $row['prdid'],
                        'productname' => $rowprd['name'],
                        'saleprice' => $rowprd['saleprice'],
                        'image' => "http://omgss.in/admin/files/prod/" . $rowprd['image'],
                        'thumbnail' => "http://omgss.in/admin/files/thumbnails/" . $rowprd['thumbnail'],
                        'discount' => number_format(((($rowprd['actualprice'] - $rowprd['saleprice']) / $rowprd['actualprice']) * 100), 2) . " %",
                        'units' => $rowprd['units'],
                        'actualprice' => $rowprd['actualprice'],
                        'quantity' => $row['quantity'],
                        'isAddedToCart' => $isAddedToCart
                    )


                );
                $subtotal = $subtotal + ($rowprd['saleprice'] * $row['quantity']);

            }
            /*$data['subtotal']=$subtotal;
            $data['taxes']=(18/100)*$subtotal;
            $data['total']=$subtotal+((18/100)*$subtotal);*/


            echo json_encode($data, JSON_NUMERIC_CHECK);

        } else {
            $response = array('status' => 'error', 'message' => 'No items in Wishlist!!');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>