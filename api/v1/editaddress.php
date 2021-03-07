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

        $addid = (isset($_POST['addid'])) ? $_POST['addid'] : '';
        $addressprofilename = (isset($_POST['addressprofilename'])) ? $_POST['addressprofilename'] : '';
        $fullname = (isset($_POST['fullname'])) ? $_POST['fullname'] : '';
        $Email = (isset($_POST['Email'])) ? $_POST['Email'] : '';
        $Address = (isset($_POST['Address'])) ? $_POST['Address'] : '';
        $City = (isset($_POST['City'])) ? $_POST['City'] : '';
        $State = (isset($_POST['State'])) ? $_POST['State'] : '';
        $Zip = (isset($_POST['Zip'])) ? $_POST['Zip'] : '';


        if ((empty($addid)) || (empty($addressprofilename)) || (empty($fullname)) || (empty($Email)) || (empty($Address)) || (empty($City)) || (empty($State)) || (empty($Zip))) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }

        mysqli_query($conn, "UPDATE `005_omgss_billingaddresses`SET `addressprofilename`='$addressprofilename',`fullname`='$fullname',`Email`='$Email',`Address`='$Address',`City`='$City',`State`='$State',`Zip`='$Zip' WHERE `id`='$addid'");


        $getresult = "SELECT * FROM `005_omgss_billingaddresses` WHERE `id`='$addid'";
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