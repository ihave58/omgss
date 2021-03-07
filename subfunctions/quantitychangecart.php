<?php
include('../include/db.php');
$id = $_GET['id'];
$action = $_GET['action'];

$sql = "SELECT * FROM `005_omgss_cart` WHERE `id`='$id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

$qnty = $row['quantity'];

if ($action == "minus") {
    if (!(($qnty - 1) < 1)) {
        $qnty--;
    }
} else if ($action == "plus") {
    $qnty++;
}

mysqli_query($conn, "UPDATE `005_omgss_cart` SET `quantity`='$qnty' WHERE `id`='$id'");

header("Location: ../cart.php");

?>