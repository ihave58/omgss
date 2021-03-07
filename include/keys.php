<?php
    date_default_timezone_set("Asia/Calcutta");

    $sqlce = "SELECT * FROM `005_omgss_companydetails` WHERE `id`=1";
    $resce = mysqli_query($conn, $sqlce);
    $rowce = mysqli_fetch_assoc($resce);

    $companyEmail = $rowce['companyemail'];
    $serverKey = 'AAAAeF-uCmU:APA91bGwvH193mEJQb6ZPODCTkn73U_yUHMLVHBtxwOV1Az2fX1CLcAB_nCbDma0kxPTC_5barm_lQtrXUgP48GeGz6NWWpAStz4U7JeaqHxFmQdytQp2o8UQYl7Q-M-93fwHzSMrDDZ';
?>