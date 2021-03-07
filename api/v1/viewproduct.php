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
        $productid = (isset($_POST['productid'])) ? $_POST['productid'] : '';


        if (empty($productid)) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }

        $incrementor = 0;
        $getresult = "SELECT * FROM 005_omgss_products WHERE id='" . $productid . "'";
        $results = mysqli_query($conn, $getresult);
        $count = mysqli_num_rows($results);
        if ($count > 0) {

            $data['status'] = 'success';
            while ($row = mysqli_fetch_assoc($results)) {
                $incrementor++;
                $data[$incrementor] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'image' => "http://omgss.in/admin/files/prod/" . $row['image'],
                    'thumbnail' => "http://omgss.in/admin/files/thumbnails/" . $row['thumbnail'],
                    'units' => $row['units'],
                    'saleprice' => $row['saleprice'],
                    'actualprice' => $row['actualprice'],
                    'discount' => number_format(((($row['actualprice'] - $row['saleprice']) / $row['actualprice']) * 100), 2) . " %",
                    'description' => $row['description'],
                    'maintenancetype' => $row['maintenancetype']


                );
            }


            echo json_encode($data, JSON_NUMERIC_CHECK);

        } else {
            $response = array('status' => 'error', 'message' => 'No Product Found!!');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>