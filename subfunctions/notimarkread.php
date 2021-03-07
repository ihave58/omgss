<?php
session_start();
error_reporting(0);
include('../include/db.php');
if (isset($_POST['action']) && $_POST['action'] == 'alertquerynoti') {


    $userid = $_POST['userid'];
    mysqli_query($conn, "UPDATE `005_omgss_usernotifications` SET `readstatus`='read' WHERE `userid`='$userid'");


}
?>