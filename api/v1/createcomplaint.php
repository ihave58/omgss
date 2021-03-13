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
        $deviceid = (isset($_POST['deviceid'])) ? runUserInputSanitizationHook($_POST['deviceid']) : '';
        $complaint = (isset($_POST['complaint'])) ? runUserInputSanitizationHook($_POST['complaint']) : '';


        if ((empty($userid)) || (empty($deviceid)) || (empty($complaint))) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }

        mysqli_query($conn, "INSERT INTO `005_omgss_complaints`(`userid`,`deviceid`,`complaint`)VALUES('$userid','$deviceid','$complaint')");
        $lastid = mysqli_insert_id($conn);


        $getresult = "SELECT * FROM `005_omgss_complaints` WHERE `id`='$lastid'";
        $results = $conn->query($getresult);
        $count = mysqli_num_rows($results);
        if ($count > 0) {
            $data['status'] = 'success';
            $counter = 0;
            $data['response'] = array();
            while ($row = $results->fetch_assoc()) {
                $counter++;

                array_push($data['response'], array(
                        'id' => $row['id'],
                        'userid' => $row['userid'],
                        'deviceid' => $row['deviceid'],
                        'complaint' => $row['complaint'],
                        'status' => $row['status']


                    )


                );
            }


            echo json_encode($data, JSON_NUMERIC_CHECK);

        } else {
            $response = array('status' => 'error', 'message' => 'No Complaints Found.!!');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>