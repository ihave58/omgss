<?php
session_start();
error_reporting(0);
include('../include/db.php');
if (isset($_POST['action']) && $_POST['action'] == 'alertqueryd') {


    $userid = $_POST['userid'];
    $prdid = $_POST['prdid'];
    $ip = $_POST['ip'];

    $count = 0;
    $sql = "SELECT * FROM `005_omgss_wishlist` WHERE `ip`='$ip' AND `prdid`='$prdid'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $count++;

    }
    if ($userid != "") {
        $sql2 = "SELECT * FROM `005_omgss_wishlist` WHERE `userid`='$userid' AND `prdid`='$prdid'";
        $res2 = mysqli_query($conn, $sql2);

        if (mysqli_num_rows($res2) > 0) {
            $count++;
        }
    }


    if ($count > 0) {
        /*echo '<script>alert("Product Already in Cart")</script>';*/
    } else {

        mysqli_query($conn, "INSERT INTO `005_omgss_wishlist` (`userid`,`ip`,`prdid`) VALUES ('$userid','$ip','$prdid')");


    }


    echo 'Added';


}
?>