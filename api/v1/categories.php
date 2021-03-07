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

        $ip = $_SERVER['REMOTE_ADDR'];
        $userid = (isset($_POST['userid'])) ? $_POST['userid'] : '';

        $getresult = "SELECT * FROM 005_omgss_categories";
        $results = $conn->query($getresult);
        $count = mysqli_num_rows($results);
        if ($count > 0) {
            $data['status'] = 'success';
            $counter = 0;
            $data['response'] = array();
            while ($row = $results->fetch_assoc()) {
                $categoryidfetch = $row['id'];
                $sqlfet = "SELECT * FROM `005_omgss_products` WHERE categoryid='" . $categoryidfetch . "'";
                $resfet = mysqli_query($conn, $sqlfet);
                $data['products'] = array();
                while ($rowfet = mysqli_fetch_assoc($resfet)) {
                    $productid = $rowfet['id'];
                    if ($userid) {
                        $sqlchkcart = "SELECT * FROM `005_omgss_cart` WHERE (`ip`='$ip' OR `userid`='$userid') AND `prdid`='$productid'";
                    } else {
                        $sqlchkcart = "SELECT * FROM `005_omgss_cart` WHERE `ip`='$ip' AND `prdid`='$productid'";
                    }

                    $reschkcart = mysqli_query($conn, $sqlchkcart);
                    if (mysqli_num_rows($reschkcart) > 0) {
                        $isAddedToCart = 1;
                    } else {
                        $isAddedToCart = 0;
                    }

                    if ($userid) {
                        $sqlchkwishlist = "SELECT * FROM `005_omgss_wishlist` WHERE (`ip`='$ip' OR `userid`='$userid') AND `prdid`='$productid'";
                    } else {
                        $sqlchkwishlist = "SELECT * FROM `005_omgss_wishlist` WHERE `ip`='$ip' AND `prdid`='$productid'";
                    }

                    $reschkwishlist = mysqli_query($conn, $sqlchkwishlist);
                    if (mysqli_num_rows($reschkwishlist) > 0) {
                        $isAddedTowishlist = 1;
                    } else {
                        $isAddedTowishlist = 0;
                    }

                    array_push($data['products'], array(
                            'id' => $rowfet['id'],
                            'name' => $rowfet['name'],
                            'image' => "http://omgss.in/admin/files/prod/" . $rowfet['image'],
                            'thumbnail' => "http://omgss.in/admin/files/thumbnails/" . $rowfet['thumbnail'],
                            'units' => $rowfet['units'],
                            'saleprice' => $rowfet['saleprice'],
                            'actualprice' => $rowfet['actualprice'],
                            'discount' => number_format(((($rowfet['actualprice'] - $rowfet['saleprice']) / $rowfet['actualprice']) * 100), 2) . " %",
                            'description' => $rowfet['description'],/*strip_tags($row['description']*/
                            'maintenancetype' => $rowfet['maintenancetype'],
                            'isAddedToCart' => $isAddedToCart,
                            'isAddedToWishlist' => $isAddedTowishlist
                        )


                    );
                }
                $counter++;
                array_push($data['response'], array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'products' => $data['products']

                    )


                );
            }


            echo json_encode($data, JSON_NUMERIC_CHECK);

        } else {
            $response = array('status' => 'error', 'message' => 'No Categories.!!');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>