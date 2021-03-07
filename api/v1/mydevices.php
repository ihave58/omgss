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

        if (empty($userid)) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }


        $getresult = "SELECT * FROM `003_omgss_devices` WHERE `userid`='$userid' ORDER BY `id` DESC";
        $results = $conn->query($getresult);
        $count = mysqli_num_rows($results);
        if ($count > 0) {
            $data['status'] = 'success';
            $counter = 0;
            $data['response'] = array();
            while ($row = $results->fetch_assoc()) {
                $prdid = $row['productid'];
                $sqlgetprd = "SELECT * FROM `005_omgss_products` WHERE `id`='$prdid'";
                $resgetprd = mysqli_query($conn, $sqlgetprd);
                $rowgetprd = mysqli_fetch_assoc($resgetprd);
                $counter++;
                $date1 = date("Y/m/d");
                $date2 = date('Y-m-d H:i:s', strtotime($row['datetime'] . ' + 365 days'));
                $diff = strtotime($date2) - strtotime($date1);
                $dateDiff = abs(round($diff / 86400));
                array_push($data['response'], array(
                        'id' => $row['id'],
                        'productid' => $row['productid'],
                        'devicename' => $rowgetprd['name'],
                        'quantity' => $row['quantity'],
                        'orderid' => $row['orderid'],
                        'startdate' => $row['datetime'],
                        'enddate' => $date2,
                        'noofdaysleft' => $dateDiff

                    )


                );
            }


            echo json_encode($data, JSON_NUMERIC_CHECK);

        } else {
            $response = array('status' => 'error', 'message' => 'No Devices Found.!!');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>