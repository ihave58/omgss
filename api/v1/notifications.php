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

        if (empty($userid)) {
            $getresult = "SELECT * FROM `005_omgss_notifications` ORDER BY `id` DESC LIMIT 20";
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
                            'image' => "http://omgss.in/admin/files/noti/" . $row['image'],
                            'description' => $row['description'],
                            'datetime' => $row['datetime']

                        )


                    );
                }


                echo json_encode($data, JSON_NUMERIC_CHECK);

            } else {
                $response = array('status' => 'error', 'message' => 'No Notifications.!!');
                echo json_encode($response);
            }
        } else {
            $getresult = "SELECT * FROM `005_omgss_usernotifications` WHERE `userid`='$userid' ORDER BY `id` DESC";
            $results = $conn->query($getresult);
            $count = mysqli_num_rows($results);
            if ($count > 0) {
                $data['status'] = 'success';
                $counter = 0;
                $data['response'] = array();
                while ($row = $results->fetch_assoc()) {
                    $notificationid = $row['notificationid'];
                    if ($notificationid == "system") {
                        array_push($data['response'], array(
                                'id' => $row['id'],
                                'image' => "http://omgss.in/images/" . $row['image'],
                                'description' => $row['content'],
                                'datetime' => $row['datetime']

                            )
                        );
                    } else {
                        $counter++;
                        $sqlgetnoti = "SELECT * FROM `005_omgss_notifications` WHERE `id`='$notificationid'";
                        $resgetnoti = mysqli_query($conn, $sqlgetnoti);
                        $rowgetnoti = mysqli_fetch_assoc($resgetnoti);

                        array_push($data['response'], array(
                                'id' => $row['id'],
                                'image' => "http://omgss.in/admin/files/noti/" . $rowgetnoti['image'],
                                'description' => $rowgetnoti['description'],
                                'datetime' => $row['datetime']

                            )


                        );
                    }

                }


                echo json_encode($data, JSON_NUMERIC_CHECK);

            } else {
                $response = array('status' => 'error', 'message' => 'No Notifications.!!');
                echo json_encode($response);
            }
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>