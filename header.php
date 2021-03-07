<?php
session_start();
include('include/db.php');
include('include/keys.php');
include('include/functions.php');

header("X-Robots-Tag: noindex, nofollow", true);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Overall Maintenance Guaranteed</title>
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="googlebot" content="noindex, nofollow"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TVSDS64');</script>
    <!-- End Google Tag Manager -->
    <style>
        .top-wrap.d-flex {
            width: max-content;
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1271px;
            }
        }

        @media only screen and (max-width: 768px) {

            form.searchform.order-lg-last {
                width: 60% !important;
            }

            .ftco-navbar-light .navbar-toggler {
                color: black !important;
            }

            .ftco-navbar-light .navbar-nav > .nav-item > .nav-link {
                color: black !important;
            }

        }

        .navbar {
            overflow: hidden;
            background-color: #333;
        }

        .navbar a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .dropdown {
            float: left;
            overflow: hidden;
        }

        .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .navbar a:hover, .dropdown:hover .dropbtn {
            background-color: red;
        }

        .dropdown-content {
            margin-top: 53px;
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .nav-item:hover .dropdown-content {
            display: block;
            position: fixed;
        }

        .nav-item:hover {
            background-color: red;
        }


        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: fixed;
            bottom: 271px;
            right: 452px;
            border: 3px solid lightgreen;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 700px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text], .form-container input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus, .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/l     ogin button */
        .form-container .btn {
            background-color: #4CAF50;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
            opacity: 1;
        }

        .headinganchors {

            padding: 0.5rem 0.5rem !important;
        }

        div#myForm1 {
            display: none;
            position: fixed;
            bottom: 280px;
            right: 0px;
            border: 3px solid lightgreen;
            z-index: 9;
            top: 88px;
            height: fit-content !important;

        }

        .form-popup {
            height: 286px !important;
        }

        @media (max-width: 640px) {
            div#myForm1 {
                /* display: none; */
                position: relative;
                bottom: 280px;
                right: 0px;
                border: 3px solid lightgreen;
                z-index: 9;
                top: 0px;
                height: fit-content !important;
            }
        }
    </style>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TVSDS64"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="wrap">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-2 d-flex align-items-center">
                <a class="navbar-brand" href="/"><img src="images/logo.png"
                                                      style="height:68px;width:112px;margin-top: -28px;position: absolute;"><span></span></a>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col">
                        <div class="top-wrap d-flex">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-home"></span></div>
                            <!-- <div class="text"><span>Address</span><span>721 New York NY 10016</span></div> -->
                            <a href="/" class="nav-link headinganchors">Home</a>
                        </div>
                    </div>

                    <?php
                    if ($_SESSION["sessid"] == "") {
                        ?>
                        <div class="col">
                            <div class="top-wrap d-flex">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-registered"></span></div>
                                <a href="register.php" class="nav-link  headinganchors">Register</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="top-wrap d-flex">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-sign-in"></span></div>
                                <a href="login.php" class="nav-link  headinganchors">Login</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>


                    <div class="col">
                        <div class="top-wrap d-flex">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-shopping-cart"></span></div>
                            <a href="cart.php" class="nav-link  headinganchors">Cart</a><sup
                                    style="color:red;top: 0.5em;font-weight: 600;font-size: larger;"
                                    id="cartcount"><?php if ($countallcart != 0) {
                                    echo $countallcart;
                                } ?></sup>
                        </div>
                    </div>
                    <div class="col">
                        <div class="top-wrap d-flex">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-shopping-cart"></span></div>
                            <a href="wishlist.php" class="nav-link  headinganchors">Wishlist</a><sup
                                    style="color:red;top: 0.5em;font-weight: 600;font-size: larger;"
                                    id="wishcount"><?php if ($countallwish != 0) {
                                    echo $countallwish;
                                } ?></sup>
                        </div>
                    </div>
                    <?php
                    if ($_SESSION["sessid"] != "") {
                        ?>
                        <div class="col">
                            <div class="top-wrap d-flex">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-user"></span></div>
                                <a href="myaccount.php" class="nav-link  headinganchors">My Account</a>
                            </div>
                        </div>

                        <div class="col">
                            <div class="top-wrap d-flex">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-mobile"></span></div>
                                <a href="mydevices.php" class="nav-link  headinganchors">My Devices</a>
                            </div>
                        </div>

                        <div class="col">

                            <div class="top-wrap d-flex">

                                <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-user"></span></div>
                                <a href="logout.php" class="nav-link  headinganchors">Logout</a>
                                <!-- <?php echo $_SESSION["name"]; ?>  -->
                            </div>
                        </div>

                        <div class="col">

                            <div class="top-wrap d-flex">


                                <?php echo $_SESSION["name"]; ?> <br>

                                omgssusr<?php echo $_SESSION["sessid"]; ?>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                    <div class="col">

                        <div class="top-wrap d-flex">


                            <a href="javascript:void(0)" id="notifbtn"><i class="fa fa-bell" aria-hidden="true"
                                                                          style="color:blue;font-size: x-large;"></i></a>
                            <superscript style="color:white;"><b id="noticountsh"></b></superscript>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar"
     style="padding: -0.5rem 1rem !important;">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span> Menu
        </button>
        <form method="post" action="search.php" class="searchform order-lg-last">
            <div class="form-group d-flex">
                <input type="text" class="form-control pl-3" name="searchtext" placeholder="Search Services">
                <button type="submit" name="searchbtn" placeholder="" class="form-control search"><span
                            class="fa fa-search"></span></button>
            </div>
        </form>


        <div class="collapse navbar-collapse" id="ftco-nav">

            <ul class="navbar-nav mr-auto">


                <?php
                while ($rowcath = mysqli_fetch_assoc($rescath)) {
                    $categoryid = $rowcath['id'];
                    $sqlcatnameh = "SELECT * FROM `005_omgss_subcategories` WHERE `catid`='$categoryid'";
                    $rescatnameh = mysqli_query($conn, $sqlcatnameh);

                    ?>
                    <li class="nav-item"><a href="moreservices.php?catid=<?php echo $rowcath['id']; ?>"
                                            class="nav-link"><?php echo $rowcath['name']; ?></a>
                        <div class="dropdown-content">
                            <?php
                            while ($rowcatnameh = mysqli_fetch_assoc($rescatnameh)) {
                                ?>
                                <a href="products.php?scatid=<?php echo $rowcatnameh['id']; ?>"><?php echo $rowcatnameh['subcatname']; ?></a>
                                <?php
                            }
                            ?>


                        </div>
                    </li>
                    <?php
                }
                ?>


            </ul>


        </div>
    </div>

</nav>

<!-- END nav -->


<script>
    $(document).ready(function () {

        setInterval(function () {
            var ip2 = "<?php echo $ip;?>";
            var userid2 = "<?php echo $_SESSION["sessid"];?>";
            $.ajax({
                type: "POST",
                url: "subfunctions/countcartitems.php",
                data: {userid: userid2, ip: ip2, action: 'alertqueryd2'},
                success: function (result) {
                    $('#cartcount').html(result);


                }
            });
        }, 1000);

        setInterval(function () {
            var ip2 = "<?php echo $ip;?>";
            var userid2 = "<?php echo $_SESSION["sessid"];?>";
            $.ajax({
                type: "POST",
                url: "subfunctions/countwishitems.php",
                data: {userid: userid2, ip: ip2, action: 'alertqueryd2'},
                success: function (result) {
                    $('#wishcount').html(result);


                }
            });
        }, 1000);

        /*setInterval(function(){ alert("Hello"); }, 3000);*/


    });
</script>


<div class="form-popup" id="myForm1">

    <form class="form-container">


        <?php
        if ($loggeduserid != "") {
            if ($countnotiuserfr > 0) {
                ?>
                <table>
                    <tbody>
                    <?php

                    while ($rownotiuserfr = mysqli_fetch_assoc($resnotiuserfr)) {

                        $notitypechk = $rownotiuserfr['notificationid'];
                        if ($notitypechk == "system") {
                            ?>
                            <tr>
                                <td><img src="images/<?php echo $rownotiuserfr['image']; ?>"
                                         style="height:50px;width:50px"></td>
                                <td><?php echo substr(strip_tags($rownotiuserfr['content']), 0, 1000); ?></td>
                            </tr>
                            <?php
                        } else {
                            $sqlnotifromtb = "SELECT * FROM `005_omgss_notifications` WHERE `id`='$notitypechk'";
                            $resnotifromtb = mysqli_query($conn, $sqlnotifromtb);
                            $rownotifromtb = mysqli_fetch_assoc($resnotifromtb);
                            ?>
                            <tr>
                                <td><img src="admin/files/noti/<?php echo $rownotifromtb['image']; ?>"
                                         style="height:50px;width:50px"></td>
                                <td><?php echo substr(strip_tags($rownotifromtb['description']), 0, 1000); ?></td>
                            </tr>

                            <?php
                        }


                    }
                    ?>

                    </tbody>
                </table>

                <?php
            } else {
                echo '<table>
				    	<tbody>
						<tr>
								    			<td><img src="images/exclain.png" style="height:50px;width:50px"></td>
								    			<td>Sorry no notifications available at this moment.</td>
							    			</tr>
						</tbody>
				    </table>';
            }
        } else {

            if ($countnoti23 > 0) {
                ?>
                <table>
                    <tbody>
                    <?php

                    while ($rownoti23 = mysqli_fetch_assoc($resnoti23)) {

                        ?>
                        <tr>
                            <td><img src="admin/files/noti/<?php echo $rownoti23['image']; ?>"
                                     style="height:50px;width:50px"></td>
                            <td><?php echo substr(strip_tags($rownoti23['description']), 0, 1000); ?></td>
                        </tr>

                        <?php


                    }
                    ?>

                    </tbody>
                </table>

                <?php
            } else {
                echo '<table>
				    	<tbody>
						<tr>
								    			<td><img src="images/exclain.png" style="height:50px;width:50px"></td>
								    			<td>Sorry no notifications available at this moment.</td>
							    			</tr>
						</tbody>
				    </table>';
            }
        }

        ?>


    </form>
</div>

<script>


    $(document).ready(function () {
        <?php
        if($loggeduserid)
        {
        ?>
        setInterval(function () {
            $.ajax({
                type: "POST",
                url: "subfunctions/notigetcount.php",
                data: {userid: <?php echo $loggeduserid; ?>, action: 'alertquerynoti2'},
                success: function (result) {
                    $("#noticountsh").html(result);


                }
            });
        }, 500);
        <?php
        }
        ?>
        <?php
        if($loggeduserid)
        {
        ?>
        setInterval(function () {
            $.ajax({
                type: "POST",
                url: "subfunctions/notiautoupdate.php",
                data: {userid: <?php echo $loggeduserid; ?>, action: 'alertquerynoti2autoupdate'},
                success: function (result) {
                    $("#myForm1").html(result);


                }
            });
        }, 5000);
        <?php
        }
        ?>
        $("#notifbtn").mouseover(function () {
            $("#myForm1").show();
            <?php
            if($loggeduserid)
            {
            ?>
            $.ajax({
                type: "POST",
                url: "subfunctions/notimarkread.php",
                data: {userid: <?php echo $loggeduserid; ?>, action: 'alertquerynoti'},
                success: function (result) {


                }
            });
            <?php
            }
            ?>

        });
        $("#notifbtn").mouseout(function () {
            $("#myForm1").hide();
        });
    });
</script>