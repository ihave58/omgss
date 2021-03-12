<?php
    include('../include/db.php');
    require("../include/utils.php");
    $id = runUserInputSanitizationHook($_GET['id']);
    $sql = "SELECT * FROM `005_omgss_wishlist` WHERE `id`='$id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    $userid = $row['userid'];
    $ip = $row['ip'];
    $prdid = $row['prdid'];
    $quantity = $row['quantity'];

    $sql1 = "SELECT * FROM `005_omgss_cart` WHERE `userid`='$userid' OR `ip`='$ip'";
    $res1 = mysqli_query($conn, $sql1);
    $counter = 0;
    while ($row1 = mysqli_fetch_assoc($res1)) {
        if ($prdid == $row1['prdid']) {
            $counter++;
        }
    }
    if ($counter > 0) {

    } else {
        mysqli_query($conn, "INSERT INTO `005_omgss_cart`(`userid`,`ip`,`prdid`,`quantity`)VALUES('$userid','$ip','$prdid','$quantity')");
    }

    mysqli_query($conn, "DELETE FROM `005_omgss_wishlist` WHERE `id`='$id'");

    header("Location: ../wishlist.php");

?>