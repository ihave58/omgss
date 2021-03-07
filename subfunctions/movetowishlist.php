<?php
include('../include/db.php');
$id = $_GET['id'];
$sql = "SELECT * FROM `005_omgss_cart` WHERE `id`='$id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

$userid = $row['userid'];
$ip = $row['ip'];
$prdid = $row['prdid'];
$quantity = $row['quantity'];

$sql1 = "SELECT * FROM `005_omgss_wishlist` WHERE `userid`='$userid' OR `ip`='$ip'";
$res1 = mysqli_query($conn, $sql1);
$counter = 0;
while ($row1 = mysqli_fetch_assoc($res1)) {
    if ($prdid == $row1['prdid']) {
        $counter++;
    }
}
if ($counter > 0) {

} else {
    mysqli_query($conn, "INSERT INTO `005_omgss_wishlist`(`userid`,`ip`,`prdid`,`quantity`)VALUES('$userid','$ip','$prdid','$quantity')");
}

mysqli_query($conn, "DELETE FROM `005_omgss_cart` WHERE `id`='$id'");

header("Location: ../cart.php");

?>