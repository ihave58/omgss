<?php
    include('../include/db.php');
    require("../include/utils.php");
    $id = runUserInputSanitizationHook($_GET['id']);
    $action = runUserInputSanitizationHook($_GET['action']);

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