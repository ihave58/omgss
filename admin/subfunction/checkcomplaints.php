<?php
    session_start();
    error_reporting(0);
    require("../../include/utils.php");
    include('../../include/db.php');
    if (isset($_POST['action']) && runUserInputSanitizationHook($_POST['action']) == 'alertqueryd2') {
        $sql = "SELECT * FROM `005_omgss_complaints` WHERE `notify`='No'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            echo 'Yes';
            mysqli_query($conn, "UPDATE `005_omgss_complaints` SET `notify`='Yes' WHERE `notify`='No'");
        }

    }
?>