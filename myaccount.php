<?php
    include('header.php');
    if ($_SESSION["sessid"] == "") {
        echo '<script>window.location.href="index.php";</script>';
    }
?>

    <link rel="stylesheet" href="css/w3.css">

    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left"
         style="width:217px; background: #0071ff;    color: white;     padding-top: 35px;" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
        <?php
            include('sidebar.php');
        ?>
    </div>

    <div class="w3-main" style="margin-left:200px;  height: 500px !important;">
        <div class="w3-teal" style="background-color: #f79f24!important;">
            <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h1 style="margin-left: 33px;color: white;">My Account</h1>
            </div>
        </div>
        <section class="ftco-section bg-light" style="min-height: 433px;">
            <div class="w3-container" style="    margin-left: 33px !important;">
                <h3>Welcome <?php echo $_SESSION["name"]; ?>,</h3>
                <p>You have <?php echo $countgetprocessingorders; ?> new orders under processing <a href="myorders.php"
                                                                                                    style="color:blue">See</a>.
                </p>
                <p>You have <?php echo $countNotexpire; ?> items for annual maintainance <a href="mydevices.php"
                                                                                            style="color:blue">See</a>.
                </p>
                <p>You can change your profile details from <a href="myprofile.php" style="color:blue">My Profile</a>.
                </p>
                <p><b>You can add your delivery addresses in <a href="myaddresses.php" style="color:blue">My
                            Addresses</a>.</b></p>
                <p><b>You can change your account password in <a href="changepassword.php" style="color:blue">Change
                            Password</a>.</b></p>
            </div>
        </section>

    </div>

    <script>
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
        }
    </script>

<?php
    include('footer.php');
?>