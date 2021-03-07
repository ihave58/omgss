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
        $catid = (isset($_POST['catid'])) ? $_POST['catid'] : '';


        if (empty($catid)) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }

        $incrementor = 0;
        $getresult = "SELECT * FROM 005_omgss_subcategories WHERE catid='" . $catid . "'";
        $results = mysqli_query($conn, $getresult);
        $count = mysqli_num_rows($results);
        if ($count > 0) {

            $data['status'] = 'success';
            $data['response'] = array();
            while ($row = mysqli_fetch_assoc($results)) {
                $incrementor++;
                array_push($data['response'], array(
                        'id' => $row['id'],
                        'subcatname' => $row['subcatname'],
                        'subcatimage' => "http://omgss.in/admin/files/sub/" . $row['subcatimage']

                    )


                );
            }


            echo json_encode($data, JSON_NUMERIC_CHECK);

        } else {
            $response = array('status' => 'error', 'message' => 'No Sub Categories Found!!');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>