<?php
    include_once '../../include/db.php';
    require "../../include/utils.php";

    if (empty($_POST['appid'])) {
        echo $response = json_encode(array('status' => 'error', 'message' => "Appid Can't be Empty"));
        exit;
    }

    $email = isset($_POST['email']) ? runUserInputSanitizationHook($_POST['email']) : '';
    $password = isset($_POST['password']) ? runUserInputSanitizationHook($_POST['password']) : '';


    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);

        exit;
    }

    if (empty($email) || empty($password)) {
        $response = ['status' => 'error', 'message' => 'Input fields cannot be empty'];
        echo json_encode($response);
        exit;
    }

    $password = md5($password);

    $getresult = "SELECT * FROM 005_omgss_users WHERE eMail='" . $email . "' AND pass='" . $password . "'";
    $results = $conn->query($getresult);
    $count = mysqli_num_rows($results);

    if ($count === 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid Credentials.!!'
        ]);

        exit;
    }

    $row = $results->fetch_assoc();
    $userId = $row['id'];
    $appId = $_POST['appid'];
    $appToken = uniqid();

    $result = $conn->query("INSERT INTO `003_omgss_api_tokens`(`user_id`, `app_id`, `app_token`, `create_time`) VALUES('$userId', '$appId', '$appToken', now()) ON DUPLICATE KEY UPDATE `app_id`='$appId', `app_token`='$appToken', `create_time`=now()");

    if (!$result) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Unable to generate authentication token!'
        ]);

        exit;
    }

    echo json_encode([
        'status' => 'success',
        'result' => [
            'id' => $row['id'],
            'eMail' => $row['eMail'],
            'Name' => $row['Name'],
            'Phone' => $row['Phone'],
            'Address' => $row['Address'],
            'Location' => $row['Location'],
            'access_token' => $appToken,
            'datetime' => $row['datetime']
        ]
    ], JSON_NUMERIC_CHECK);
?>