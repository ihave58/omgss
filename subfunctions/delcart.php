<?php
include('../include/db.php');
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM `005_omgss_cart` WHERE `id`='$id'");

header("Location: ../cart.php");

?>