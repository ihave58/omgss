<?php
session_start();
error_reporting(0);
include('../include/db.php');
if (isset($_POST['action']) && $_POST['action'] == 'alertqueryd2') {


    $userid = $_POST['userid'];

    $ip = $_POST['ip'];

    if ($userid) {
        $sql = "SELECT * FROM `005_omgss_wishlist` WHERE `userid`='$userid' OR `ip`='$ip'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
    } else {
        $sql = "SELECT * FROM `005_omgss_wishlist` WHERE `ip`='$ip'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
    }


    if ($count != 0) {
        echo $count;
    }


}
?>