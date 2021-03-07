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
        $addressprofilename = (isset($_POST['addressprofilename'])) ? runUserInputSanitizationHook($_POST['addressprofilename']) : '';
        $fullname = (isset($_POST['fullname'])) ? runUserInputSanitizationHook($_POST['fullname']) : '';
        $Email = (isset($_POST['Email'])) ? runUserInputSanitizationHook($_POST['Email']) : '';
        $Address = (isset($_POST['Address'])) ? runUserInputSanitizationHook($_POST['Address']) : '';
        $City = (isset($_POST['City'])) ? runUserInputSanitizationHook($_POST['City']) : '';
        $State = (isset($_POST['State'])) ? runUserInputSanitizationHook($_POST['State']) : '';
        $Zip = (isset($_POST['Zip'])) ? runUserInputSanitizationHook($_POST['Zip']) : '';


        if ((empty($userid)) || (empty($addressprofilename)) || (empty($fullname)) || (empty($Email)) || (empty($Address)) || (empty($City)) || (empty($State)) || (empty($Zip))) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }

        mysqli_query($conn, "INSERT INTO `005_omgss_billingaddresses`(`userid`,`addressprofilename`,`fullname`,`Email`,`Address`,`City`,`State`,`Zip`)VALUES('$userid','$addressprofilename','$fullname','$Email','$Address','$City','$State','$Zip')");
        $lastid = mysqli_insert_id($conn);


        $getresult = "SELECT * FROM `005_omgss_billingaddresses` WHERE `id`='$lastid'";
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
                        'addressprofilename' => $row['addressprofilename'],
                        'fullname' => $row['fullname'],
                        'Email' => $row['Email'],
                        'Address' => $row['Address'],
                        'City' => $row['City'],
                        'State' => $row['State'],
                        'Zip' => $row['Zip']


                    )


                );
            }


            echo json_encode($data, JSON_NUMERIC_CHECK);

        } else {
            $response = array('status' => 'error', 'message' => 'No Address Found.!!');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>