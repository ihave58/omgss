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
            $sqlcountallcart = "SELECT * FROM `005_omgss_cart` WHERE `ip`='$ip' OR `userid`='$userid'";
        } else {
            $sqlcountallcart = "SELECT * FROM `005_omgss_cart` WHERE `ip`='$ip'";
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
                array_push($data['orderdetails'], array(
                        'id' => $row['id'],
                        'prdid' => $row['prdid'],
                        'productname' => $rowprd['name'],
                        'saleprice' => $rowprd['saleprice'],
                        'image' => "http://omgss.in/admin/files/prod/" . $rowprd['image'],
                        'thumbnail' => "http://omgss.in/admin/files/thumbnails/" . $rowprd['thumbnail'],
                        'units' => $rowprd['units'],
                        'quantity' => $row['quantity']

                    )


                );
                $subtotal = $subtotal + ($rowprd['saleprice'] * $row['quantity']);

            }
            $data['subtotal'] = $subtotal;
            $data['taxpercent'] = 18;
            $data['taxes'] = (18 / 100) * $subtotal;
            $data['total'] = $subtotal + ((18 / 100) * $subtotal);


            echo json_encode($data, JSON_NUMERIC_CHECK);

        } else {
            $response = array('status' => 'error', 'message' => 'No items in Cart!!');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>