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
        $eMail = (isset($_POST['eMail'])) ? runUserInputSanitizationHook($_POST['eMail']) : '';
        $Name = (isset($_POST['Name'])) ? runUserInputSanitizationHook($_POST['Name']) : '';
        $Phone = (isset($_POST['Phone'])) ? runUserInputSanitizationHook($_POST['Phone']) : '';
        $Address = (isset($_POST['Address'])) ? runUserInputSanitizationHook($_POST['Address']) : '';
        $Location = (isset($_POST['Location'])) ? runUserInputSanitizationHook($_POST['Location']) : '';


        if ((empty($userid)) || (empty($eMail)) || (empty($Name)) || (empty($Phone)) || (empty($Address)) || (empty($Location))) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }

        mysqli_query($conn, "UPDATE `005_omgss_users`SET `eMail`='$eMail',`Name`='$Name',`Phone`='$Phone',`Address`='$Address',`Location`='$Location' WHERE `id`='$userid'");


        $getresult = "SELECT * FROM `005_omgss_users` WHERE `id`='$userid'";
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
                        'eMail' => $row['eMail'],
                        'Name' => $row['Name'],
                        'Phone' => $row['Phone'],
                        'Address' => $row['Address'],
                        'Location' => $row['Location']


                    )


                );
            }


            echo json_encode($data, JSON_NUMERIC_CHECK);

        } else {
            $response = array('status' => 'error', 'message' => 'No User Found.!!');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>