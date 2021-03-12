<?php
    session_start();
    require("../include/utils.php");
    if ($_SESSION["sessid"] == "") {
        echo '<script>window.location.href="../index.php";</script>';
        die;
    }
    include('../include/db.php');
    $id = runUserInputSanitizationHook($_GET['id']);
    $sql = "SELECT * FROM `005_omgss_billingaddresses` WHERE `id`='$id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    if ($row['userid'] != $_SESSION["sessid"]) {
        echo '<script>window.location.href="../index.php";</script>';
        die;
    }
    mysqli_query($conn, "DELETE FROM `005_omgss_billingaddresses` WHERE `id`='$id'");

    header("Location: ../myaddresses.php");

?>