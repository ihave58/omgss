<?php
    session_start();
    error_reporting(0);
    include('../include/db.php');
    if (isset($_POST['action']) && runUserInputSanitizationHook($_POST['action']) == 'alertquerydf') {


        $userid = runUserInputSanitizationHook($_POST['userid']);
        $prdid = runUserInputSanitizationHook($_POST['prdid']);
        $ip = runUserInputSanitizationHook($_POST['ip']);
        $qnty = runUserInputSanitizationHook($_POST['qnty']);
        $idcartchk = runUserInputSanitizationHook($_POST['idcartchk']);

        $count = 0;
        $sql = "SELECT * FROM `005_omgss_cart` WHERE `ip`='$ip' AND `prdid`='$prdid'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            $count++;

        }
        if ($userid != "") {
            $sql2 = "SELECT * FROM `005_omgss_cart` WHERE `userid`='$userid' AND `prdid`='$prdid'";
            $res2 = mysqli_query($conn, $sql2);

            if (mysqli_num_rows($res2) > 0) {
                $count++;
            }
        }


        if ($count > 0) {
            /*echo '<script>alert("Product Already in Cart")</script>';*/
            mysqli_query($conn, "UPDATE `005_omgss_cart` SET `quantity`='$qnty' WHERE `id`='$idcartchk'");
        } else {

            mysqli_query($conn, "INSERT INTO `005_omgss_cart` (`userid`,`ip`,`prdid`,`quantity`) VALUES ('$userid','$ip','$prdid','$qnty')");


        }


        echo 'Added';


    }
?>