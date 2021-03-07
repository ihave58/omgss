<?php
    $sqlall = "SELECT * FROM `003_facerecog_users` Order BY `id` DESC";
    $resall = mysqli_query($conn, $sqlall);

    $countall = mysqli_num_rows($resall);

?>