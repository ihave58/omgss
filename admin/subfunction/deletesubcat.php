<?php
    require("../../include/utils.php");
    include('../../include/db.php');
    $id = runUserInputSanitizationHook($_GET['id']);
    $catid = runUserInputSanitizationHook($_GET['catid']);

    mysqli_query($conn, "DELETE FROM `005_omgss_subcategories` WHERE `id`='$id'");

    header("Location: ../subcategories.php?catid=" . $catid);

?>