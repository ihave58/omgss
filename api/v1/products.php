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
        $catid = (isset($_POST['catid'])) ? runUserInputSanitizationHook($_POST['catid']) : '';
        $subcatid = (isset($_POST['subcatid'])) ? runUserInputSanitizationHook($_POST['subcatid']) : '';
        $ip = $_SERVER['REMOTE_ADDR'];
        $userid = (isset($_POST['userid'])) ? runUserInputSanitizationHook($_POST['userid']) : '';


        if (empty($catid) && !(empty($subcatid))) {
            $incrementor = 0;
            $getresult = "SELECT * FROM 005_omgss_products WHERE subcategoryid='" . $subcatid . "'";
            $results = mysqli_query($conn, $getresult);
            $count = mysqli_num_rows($results);
            if ($count > 0) {

                $data['status'] = 'success';
                $data['response'] = array();
                while ($row = mysqli_fetch_assoc($results)) {
                    $productid = $row['id'];
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
                    $incrementor++;
                    array_push($data['response'], array(
                            'id' => $row['id'],
                            'name' => $row['name'],
                            'image' => "http://omgss.in/admin/files/prod/" . $row['image'],
                            'thumbnail' => "http://omgss.in/admin/files/thumbnails/" . $row['thumbnail'],
                            'units' => $row['units'],
                            'saleprice' => $row['saleprice'],
                            'actualprice' => $row['actualprice'],
                            'discount' => number_format(((($row['actualprice'] - $row['saleprice']) / $row['actualprice']) * 100), 2) . " %",
                            'description' => $row['description'],/*strip_tags($row['description']*/
                            'maintenancetype' => $row['maintenancetype'],
                            'isAddedToCart' => $isAddedToCart,
                            'isAddedToWishlist' => $isAddedTowishlist

                        )


                    );
                }


                echo json_encode($data, JSON_NUMERIC_CHECK);

            } else {
                $response = array('status' => 'error', 'message' => 'No Products Found!!');
                echo json_encode($response);
            }
        } else if (!(empty($catid)) && empty($subcatid)) {
            $incrementor = 0;
            $getresult = "SELECT * FROM 005_omgss_products WHERE categoryid='" . $catid . "'";
            $results = mysqli_query($conn, $getresult);
            $count = mysqli_num_rows($results);
            if ($count > 0) {

                $data['status'] = 'success';
                $data['response'] = array();
                while ($row = mysqli_fetch_assoc($results)) {
                    $productid = $row['id'];
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
                    $incrementor++;
                    array_push($data['response'], array(
                            'id' => $row['id'],
                            'name' => $row['name'],
                            'image' => "http://omgss.in/admin/files/prod/" . $row['image'],
                            'thumbnail' => "http://omgss.in/admin/files/thumbnails/" . $row['thumbnail'],
                            'discount' => number_format(((($row['actualprice'] - $row['saleprice']) / $row['actualprice']) * 100), 2) . " %",
                            'units' => $row['units'],
                            'saleprice' => $row['saleprice'],
                            'actualprice' => $row['actualprice'],
                            'description' => $row['description'],/*strip_tags($row['description']*/
                            'maintenancetype' => $row['maintenancetype'],
                            'isAddedToCart' => $isAddedToCart,
                            'isAddedToWishlist' => $isAddedTowishlist

                        )


                    );
                }


                echo json_encode($data, JSON_NUMERIC_CHECK);

            } else {
                $response = array('status' => 'error', 'message' => 'No Products Found!!');
                echo json_encode($response);
            }
        } else if (empty($catid) && empty($subcatid)) {
            $incrementor = 0;
            $getresult = "SELECT * FROM 005_omgss_products";
            $results = mysqli_query($conn, $getresult);
            $count = mysqli_num_rows($results);
            if ($count > 0) {

                $data['status'] = 'success';
                $data['response'] = array();
                while ($row = mysqli_fetch_assoc($results)) {
                    $productid = $row['id'];
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
                    $incrementor++;
                    array_push($data['response'], array(
                            'id' => $row['id'],
                            'name' => $row['name'],
                            'image' => "http://omgss.in/admin/files/prod/" . $row['image'],
                            'thumbnail' => "http://omgss.in/admin/files/thumbnails/" . $row['thumbnail'],
                            'discount' => number_format(((($row['actualprice'] - $row['saleprice']) / $row['actualprice']) * 100), 2) . " %",
                            'units' => $row['units'],
                            'saleprice' => $row['saleprice'],
                            'actualprice' => $row['actualprice'],
                            'description' => $row['description'],/*strip_tags($row['description']*/
                            'maintenancetype' => $row['maintenancetype'],
                            'isAddedToCart' => $isAddedToCart,
                            'isAddedToWishlist' => $isAddedTowishlist

                        )


                    );
                }


                echo json_encode($data, JSON_NUMERIC_CHECK);

            }
        } else if (!(empty($catid)) && !(empty($subcatid))) {
            $incrementor = 0;
            $getresult = "SELECT * FROM 005_omgss_products WHERE categoryid='" . $catid . "' AND subcategoryid='" . $subcatid . "'";
            $results = mysqli_query($conn, $getresult);
            $count = mysqli_num_rows($results);
            if ($count > 0) {

                $data['status'] = 'success';
                $data['response'] = array();
                while ($row = mysqli_fetch_assoc($results)) {
                    $productid = $row['id'];
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
                    $incrementor++;
                    array_push($data['response'], array(
                            'id' => $row['id'],
                            'name' => $row['name'],
                            'image' => "http://omgss.in/admin/files/prod/" . $row['image'],
                            'thumbnail' => "http://omgss.in/admin/files/thumbnails/" . $row['thumbnail'],
                            'discount' => number_format(((($row['actualprice'] - $row['saleprice']) / $row['actualprice']) * 100), 2) . " %",
                            'units' => $row['units'],
                            'saleprice' => $row['saleprice'],
                            'actualprice' => $row['actualprice'],
                            'description' => $row['description'],/*strip_tags($row['description']*/
                            'maintenancetype' => $row['maintenancetype'],
                            'isAddedToCart' => $isAddedToCart,
                            'isAddedToWishlist' => $isAddedTowishlist

                        )


                    );
                }


                echo json_encode($data, JSON_NUMERIC_CHECK);

            } else {
                $response = array('status' => 'error', 'message' => 'No Products Found!!');
                echo json_encode($response);
            }
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>