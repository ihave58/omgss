<?php

    session_start();
    include('../../include/db.php');
    error_reporting(0);

    if (isset($_POST['action']) && runUserInputSanitizationHook($_POST['action']) == 'query4') {
        echo '<option selected disabled>Select</option>';
        $categoryval = runUserInputSanitizationHook($_POST['categoryval']);

        $sqlsubcats = "SELECT * FROM `005_omgss_subcategories` WHERE `catid`='$categoryval'";
        $ressubcats = mysqli_query($conn, $sqlsubcats);
        while ($rowsubcats = mysqli_fetch_assoc($ressubcats)) {
            echo '<option value="' . $rowsubcats['id'] . '">' . $rowsubcats['subcatname'] . '</option>';
        }


    }

?>