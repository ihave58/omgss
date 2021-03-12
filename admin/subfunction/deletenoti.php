<?php
    require("../../include/utils.php");
    include('../../include/db.php');
    $id = runUserInputSanitizationHook($_GET['id']);

    mysqli_query($conn, "DELETE FROM `005_omgss_notifications` WHERE `id`='$id'");
    mysqli_query($conn, "DELETE FROM `005_omgss_usernotifications` WHERE `notificationid`='$id'");

    header("Location: ../notifications.php");

?>