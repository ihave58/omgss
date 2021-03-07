<?php
    session_start();
    error_reporting(0);
    include('../../include/db.php');
    if (isset($_POST['action']) && runUserInputSanitizationHook($_POST['action']) == 'alertqueryd3') {
        $sql = "SELECT * FROM `005_omgss_complaints` WHERE `countnotify`='No'";
        $res = mysqli_query($conn, $sql);
        $getcount = mysqli_num_rows($res);
        if ($getcount > 0) {
            echo $getcount;
        }

    }
?>