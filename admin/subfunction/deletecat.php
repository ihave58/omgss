<?php
	require("../../include/utils.php");
    include('../../include/db.php');
    $id = runUserInputSanitizationHook($_GET['id']);

    mysqli_query($conn, "DELETE FROM `005_omgss_categories` WHERE `id`='$id'");

    header("Location: ../categories.php");

?>