<?php
include('../../include/db.php');
$id = $_GET['id'];
$catid = $_GET['catid'];

mysqli_query($conn, "DELETE FROM `005_omgss_subcategories` WHERE `id`='$id'");

header("Location: ../subcategories.php?catid=" . $catid);

?>