<?php
    include('../include/db.php');
    $id = runUserInputSanitizationHook($_GET['id']);

    mysqli_query($conn, "DELETE FROM `005_omgss_wishlist` WHERE `id`='$id'");

    header("Location: ../wishlist.php");

?>