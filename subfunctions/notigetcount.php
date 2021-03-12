<?php
    session_start();
    error_reporting(0);
    include('../include/db.php');
    require("../include/utils.php");
    if (isset($_POST['action']) && runUserInputSanitizationHook($_POST['action']) == 'alertquerynoti2') {


        $userid = runUserInputSanitizationHook($_POST['userid']);
        $sqlnotiuserfr = "SELECT * FROM `005_omgss_usernotifications` WHERE `userid`='$userid' AND `readstatus`='unread' ORDER BY `id` DESC";
        $resnotiuserfr = mysqli_query($conn, $sqlnotiuserfr);
        $countnotiuserfr = mysqli_num_rows($resnotiuserfr);


        if ($countnotiuserfr > 0) {
            echo $countnotiuserfr;
        }


    }
?>