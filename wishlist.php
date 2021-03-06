<?php
    include('header.php');

?>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Fredoka+One);


        ::selection {
            background: #bdc0e8;
        }

        ::-moz-selection {
            background: #bdc0e8;
        }

        ::-webkit-selection {
            background: #bdc0e8;
        }

        br {
            display: block;
            line-height: 1.6em;
        }

        article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {
            display: block;
        }

        ol, ul {
            list-style: none;
        }

        input, textarea {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            outline: none;
        }

        blockquote, q {
            quotes: none;
        }

        blockquote:before, blockquote:after, q:before, q:after {
            content: '';
            content: none;
        }

        strong, b {
            font-weight: bold;
        }

        em, i {
            font-style: italic;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        img {
            border: 0;
            max-width: 100%;
        }

        h2 {
            /*font-family: 'Fredoka One', Helvetica, Tahoma, sans-serif;*/
            color: #fff;

            font-size: 4.5em;
            line-height: 1.1em;

            font-weight: bolder;
            /*text-align: center;*/
        }


        /* page structure */
        #w {
            display: block;
            /*width: 1100px;*/
            width: 1358px;
            margin: 0 auto;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 62.5%;
            line-height: 1;
            color: #414141;
        }

        #title {
            display: block;
            width: 100%;
            background: #95a6d6;
            padding: 10px 0;
            -webkit-border-top-right-radius: 6px;
            -webkit-border-top-left-radius: 6px;
            -moz-border-radius-topright: 6px;
            -moz-border-radius-topleft: 6px;
            border-top-right-radius: 6px;
            border-top-left-radius: 6px;
        }

        #page {
            display: block;
            background: #fff;
            padding: 15px 0;
            -webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
            -moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        }

        /** cart table **/
        #cart {
            background: #e0e0e0;
            /*display: block;*/
            border-collapse: collapse;
            margin: 0;
            width: 100%;
            font-size: 2.2em;
            color: #444;
        }

        #cart thead th {
            padding: 8px 0;
            font-weight: bold;
        }

        #cart thead th.first {
            width: 175px;
        }

        #cart thead th.second {
            width: 45px;
        }

        #cart thead th.third {
            width: 230px;
        }

        #cart thead th.fourth {
            width: 130px;
        }

        #cart thead th.fifth {
            width: 20px;
        }

        #cart tbody td {
            text-align: center;
            margin-top: 4px;
        }

        tr.productitm {
            height: 65px;
            line-height: 65px;
            border-bottom: 1px solid #d7dbe0;
        }


        #cart tbody td img.thumb {
            vertical-align: bottom;
            border: 1px solid #ddd;
            margin-bottom: 4px;
        }

        .qtyinput {
            width: 33px;
            height: 22px;
            border: 1px solid #a3b8d3;
            background: #dae4eb;
            color: #616161;
            text-align: center;
        }

        tr.totalprice, tr.extracosts {
            height: 35px;
            line-height: 35px;
        }

        tr.extracosts {
            background: #e4edf4;
        }

        .remove {
            /* http://findicons.com/icon/261449/trash_can?id=397422 */
            cursor: pointer;
            position: relative;
            right: 12px;
            top: 5px;
        }


        .light {
            color: #888b8d;
            text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.45);
            font-size: 1.1em;
            font-weight: normal;
        }

        .thick {
            color: #272727;
            font-size: 1.7em;
            font-weight: bold;
        }


        /** submit btn **/
        tr.checkoutrow {
            background: #cfdae8;
            border-top: 1px solid #abc0db;
            border-bottom: 1px solid #abc0db;
        }

        td.checkout {
            padding: 12px 0;
            padding-top: 20px;
            width: 100%;
            text-align: right;
        }


        /* https://codepen.io/guvootes/pen/eyDAb */
        #submitbtn {
            width: 150px;
            height: 35px;
            outline: none;
            border: none;
            border-radius: 5px;
            margin: 0 0 10px 0;
            font-size: 0.75em;;
            letter-spacing: 0.05em;
            font-family: Arial, Tahoma, sans-serif;
            color: #fff;
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.2);
            cursor: pointer;
            overflow: hidden;
            border-bottom: 1px solid #0071ff;
            background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #66aaff), color-stop(100%, #4d9cff));
            background-image: -webkit-linear-gradient(#66aaff, #4d9cff);
            background-image: -moz-linear-gradient(#66aaff, #4d9cff);
            background-image: -o-linear-gradient(#66aaff, #4d9cff);
            background-image: linear-gradient(#66aaff, #4d9cff);
        }

        #submitbtn:hover {
            background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #4d9cff), color-stop(100%, #338eff));
            background-image: -webkit-linear-gradient(#4d9cff, #338eff);
            background-image: -moz-linear-gradient(#4d9cff, #338eff);
            background-image: -o-linear-gradient(#4d9cff, #338eff);
            background-image: linear-gradient(#4d9cff, #338eff);
        }

        #submitbtn:active {
            border-bottom: 0;
            background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #338eff), color-stop(100%, #4d9cff));
            background-image: -webkit-linear-gradient(#338eff, #4d9cff);
            background-image: -moz-linear-gradient(#338eff, #4d9cff);
            background-image: -o-linear-gradient(#338eff, #4d9cff);
            background-image: linear-gradient(#338eff, #4d9cff);
            -webkit-box-shadow: inset 0 1px 3px 1px rgba(0, 0, 0, 0.25);
            -moz-box-shadow: inset 0 1px 3px 1px rgba(0, 0, 0, 0.25);
            box-shadow: inset 0 1px 3px 1px rgba(0, 0, 0, 0.25);
        }

        .plusminus {
            background: azure;
            padding: 5px;
        }

        @media (max-width: 640px) {
            #w {
                display: block;
                width: 100%;
            }

            #page {
                padding: 15px 11px;
            }
        }
    </style>
    <style>


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

        /* Set a style for the submit/login button */
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

        @media only screen and (max-width: 768px) {

            .cartwish {
                height: 100px !important;
            }

        }

        .cartwish {
            height: 200px;
            width: 250px;
            border-radius: 20%;
        }
    </style>

    <body>
    <div id="w">
        <header id="title">
            <h2 style="text-align: center;text-shadow: 1px 2px 0 #7184d8; padding: 6px 0;">Wishlist</h2>
        </header>
        <div id="page">
            <?php
                if ($countallwish > 0) {
                    ?>
                    <table id="cart">
                        <thead style="text-align: center;">
                        <tr>
                            <th class="first">Service Image</th>
                            <th class="third">Service Name</th>
                            <th class="fourth">Move To Cart</th>
                            <th class="fifth">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- shopping cart contents -->


                        <?php


                            $carttotal = 0;
                            while ($rowallwish = mysqli_fetch_assoc($rescountallwish)) {
                                $productidwish = $rowallwish['prdid'];
                                $sqlechprd = "SELECT * FROM `005_omgss_products` WHERE `id`='$productidwish'";
                                $resechprd = mysqli_query($conn, $sqlechprd);
                                $rowechprd = mysqli_fetch_assoc($resechprd);

                                ?>
                                <tr class="productitm">
                                    <!-- http://www.inkydeals.com/deal/ginormous-bundle/ -->
                                    <td><img src="admin/files/prod/<?php echo $rowechprd['image']; ?>"
                                             class="thumb cartwish"
                                             style=""></td>

                                    <td><?php echo $rowechprd['name']; ?></td>
                                    <td><a href="subfunctions/movetocart.php?id=<?php echo $rowallwish['id']; ?>"><i
                                                    class="fa fa-shopping-cart" aria-hidden="true"
                                                    style="color:blue"></i></a>
                                    </td>
                                    <td><a href="subfunctions/delwish.php?id=<?php echo $rowallwish['id']; ?>"
                                           onclick="return confirm('Are you sure you want to delete this item')"><span
                                                    class="remove"><i class="fa fa-trash"
                                                                      style="    font-size: x-large;color:red"
                                                                      aria-hidden="true"></i></span></a></td>
                                </tr>
                                <?php
                            }

                        ?>


                        </tbody>
                    </table>
                    <?php
                } else {
                    echo '<h3 style="color:red">No items to display</h3>';
                }
            ?>
        </div>
    </div>
    </body>


<?php
    include('footer.php');
?>