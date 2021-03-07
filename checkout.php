<?php
    require('razorpay/config.php');
    require('razorpay/razorpay-php/Razorpay.php');

    use Razorpay\Api\Api;

    include('header.php');
    if ($_SESSION['sessid'] == "") {
        echo '<script>window.location.href="index.php";</script>';
    }

    if (isset($_POST['checkoutbtn'])) {
        $totalvalue = $_SESSION['totalvalue'];
        $fullname = runUserInputSanitizationHook($_POST['fullname']);
        $email = runUserInputSanitizationHook($_POST['email']);
        $address = runUserInputSanitizationHook($_POST['address']);
        $city = runUserInputSanitizationHook($_POST['city']);
        $state = runUserInputSanitizationHook($_POST['state']);
        $zip = runUserInputSanitizationHook($_POST['zip']);
        $paytype = runUserInputSanitizationHook($_POST['paytype']);
        $_SESSION['paytype'] = $paytype;
        $couponidsvdb = $_SESSION['coupidfrsv'];

        $orderdetails = array();
        $countpl = 0;
        $sqlcountallcartor = "SELECT * FROM `005_omgss_cart` WHERE `ip`='$ip' OR `userid`='$loggeduserid'";
        $rescountallcartor = mysqli_query($conn, $sqlcountallcartor);
        while ($rowcountallcartor = mysqli_fetch_assoc($rescountallcartor)) {
            $countpl++;
            $productcartidpl = $rowcountallcartor['prdid'];
            $quantitycartidpl = $rowcountallcartor['quantity'];
            $sqlgetsproductdet = "SELECT * FROM `005_omgss_products` WHERE `id`='$productcartidpl'";
            $resgetsproductdet = mysqli_query($conn, $sqlgetsproductdet);
            $rowgetsproductdet = mysqli_fetch_assoc($resgetsproductdet);
            $orderdetails[$countpl] = array(
                'productid' => $productcartidpl,
                'saleprice' => $rowgetsproductdet['saleprice'],
                'quantity' => $quantitycartidpl,
            );
        }
        $sqlgetscoupdet = "SELECT * FROM `005_omgss_coupons` WHERE `id`='$couponidsvdb'";
        $resgetscoupdet = mysqli_query($conn, $sqlgetscoupdet);
        $rowgetscoupdet = mysqli_fetch_assoc($resgetscoupdet);
        $coupondetails = $rowgetscoupdet;
        $coupondetailsjs = json_encode($coupondetails);
        $orderdetailsjs = json_encode($orderdetails);
        $dateind = date("Y-m-d") . " " . date("h:i:sa");
        if ($paytype == "cos") {

            $sqlcreate = "INSERT INTO `005_omgss_orders` (`userid`,`orderdetails`,`fullname`,`email`,`address`,`city`,`state`,`zip`,`paymenttype`,`totalordervalue`,`status`,`couponcode`,`coupondetails`,`datetimeind`) VALUES ('$loggeduserid','$orderdetailsjs','$fullname','$email','$address','$city','$state','$zip','$paytype','$totalvalue','Success','$couponidsvdb','$coupondetailsjs','$dateind')";


            if ($conn->query($sqlcreate) === TRUE) {
                $_SESSION['lastid'] = mysqli_insert_id($conn);
                mysqli_query($conn, "DELETE FROM `005_omgss_cart` WHERE `ip`='$ip' OR `userid`='$loggeduserid'");
                $messnoti = "Your Order OMGORD" . $_SESSION['lastid'] . " has been received by us";
                mysqli_query($conn, "INSERT INTO `005_omgss_usernotifications`(`userid`,`image`,`content`)VALUES('$loggeduserid','pass.png','$messnoti')");

                $_SESSION['dsc'] = 0;
                $_SESSION['totalvalue'] = 0;
                $_SESSION['cccode'] = "";
                $_SESSION['dsctype'] = 0;

                echo '<script>window.location.href="thankyou.php";</script>';
            } else {

                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Something Went Wrong!!!",
                        text: "Order Not Placed",
                        icon: "error",
                        closeOnClickOutside: false,
                   })
            

                    });
                    $(document).on("click", "#btnA", function() {
                        alert(this.id);
                  });
                   
                  </script>
                    ';

            }
        } else if ($paytype == "prep") {
            $sqlcreate = "INSERT INTO `005_omgss_orders` (`userid`,`orderdetails`,`fullname`,`email`,`address`,`city`,`state`,`zip`,`paymenttype`,`totalordervalue`,`couponcode`,`coupondetails`,`datetimeind`) VALUES ('$loggeduserid','$orderdetailsjs','$fullname','$email','$address','$city','$state','$zip','$paytype','$totalvalue','$couponidsvdb','$coupondetailsjs','$dateind')";
            $rescreate = mysqli_query($conn, $sqlcreate);
            $_SESSION['lastid'] = mysqli_insert_id($conn);
            $api = new Api($keyId, $keySecret);

            //
            // We create an razorpay order using orders api
            // Docs: https://docs.razorpay.com/docs/orders
            //
            $orderData = [
                'receipt' => 3456,
                'amount' => $totalvalue * 100, // 2000 rupees in paise
                'currency' => 'INR',
                'payment_capture' => 1 // auto capture
            ];

            $razorpayOrder = $api->order->create($orderData);

            $razorpayOrderId = $razorpayOrder['id'];

            $_SESSION['razorpay_order_id'] = $razorpayOrderId;

            $displayAmount = $amount = $orderData['amount'];

            if ($displayCurrency !== 'INR') {
                /* $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                 $exchange = json_decode(file_get_contents($url), true);

                 $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;*/
            }

            $checkout = 'automatic';

            if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true)) {
                $checkout = runUserInputSanitizationHook($_GET['checkout']);
            }

            $data = [
                "key" => $keyId,
                "amount" => $totalvalue,
                "name" => "",
                "description" => "",
                "image" => "images/logo.png",
                "prefill" => [
                    "name" => "",
                    "email" => "",
                    "contact" => "",
                ],
                "notes" => [
                    "address" => "",
                    "merchant_order_id" => "",
                ],
                "theme" => [
                    "color" => "#F37254"
                ],
                "order_id" => $razorpayOrderId,
            ];

            if ($displayCurrency !== 'INR') {
                $data['display_currency'] = $displayCurrency;
                $data['display_amount'] = $displayAmount;
            }

            $json = json_encode($data);

            require("razorpay/checkout/{$checkout}.php");


        }


    }

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>


            .row1 {
                display: -ms-flexbox; /* IE10 */
                display: flex;
                -ms-flex-wrap: wrap; /* IE10 */
                flex-wrap: wrap;
                margin: 25px 45px;
            }

            .col-25 {
                -ms-flex: 25%; /* IE10 */
                flex: 25%;
            }

            .col-50 {
                -ms-flex: 50%; /* IE10 */
                flex: 50%;
            }

            .col-75 {
                -ms-flex: 75%; /* IE10 */
                flex: 75%;
            }

            .col-25,
            .col-50,
            .col-75 {
                padding: 0 16px;
            }

            .container1 {
                background-color: #f2f2f2;
                padding: 5px 20px 15px 20px;
                border: 1px solid lightgrey;
                border-radius: 3px;
            }

            input[type=text] {
                width: 100%;
                margin-bottom: 20px;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            label {
                margin-bottom: 10px;
                display: block;
            }

            .icon-container1 {
                margin-bottom: 20px;
                padding: 7px 0;
                font-size: 24px;
            }

            .btn {
                background-color: #0071ff;
                color: white;
                padding: 12px;
                margin: 10px 0;
                border: none;
                width: 100%;
                border-radius: 3px;
                cursor: pointer;
                font-size: 17px;
            }

            .btn:hover {
                background-color: #66aaff;
            }


            hr {
                border: 1px solid lightgrey;
            }

            span.price {
                float: right;
                color: grey;
            }

            /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
            @media (max-width: 800px) {
                .row1 {
                    flex-direction: column-reverse;
                }

                .col-25 {
                    margin-bottom: 20px;
                }
            }

            #title {
                display: block;
                width: 92%;
                margin-left: 61px;
                background: #66aaff;
                padding: 10px 0;
                -webkit-border-top-right-radius: 6px;
                -webkit-border-top-left-radius: 6px;
                -moz-border-radius-topright: 6px;
                -moz-border-radius-topleft: 6px;
                border-top-right-radius: 6px;
                border-top-left-radius: 6px;
            }

            input[type=radio] {
                display: none;
            }

            input[type=radio] {
                content: '';
                display: inline-block;
                border: 1px solid #000;
                border-radius: 50%;
                margin: 0 0.5em;
            }

            input[type=radio]:checked {
                background-color: #ffa;
            }

            .radio4 {
                width: 1.0em;
                height: 1.0em;
            }

            #chkbtn {
                width: 35%;
                margin: 0 341px;
            }

            @media (max-width: 640px) {
                #title {
                    width: 100%;
                    margin-left: 0;
                    padding: 10px 0;
                }

                .col-25 {
                    margin-bottom: 20px;
                    WIDTH: 100%;
                }

                .col-25, .col-50, .col-75 {
                    padding: 0 16px;
                    WIDTH: 100%;
                }

                #chkbtn {
                    width: 100%;
                    margin: 0px;
                }

                .container1 {
                    width: 100%;
                }

                .row1 {
                    display: -ms-flexbox;
                    display: block;
                    -ms-flex-wrap: wrap;
                    /* flex-wrap: wrap; */
                    margin: 0px;
                    width: 100%;
                }

                .container1 select {
                    text-transform: none;
                    font-size: small;
                    width: 60% !important;
                }

            }
        </style>
    </head>
    <body>
    <header id="title">
        <h2 style="    font-family: 'Fredoka One', Helvetica, Tahoma, sans-serif;
    color: #fff;
    text-shadow: 1px 2px 0 #7184d8;
    font-size: 3.5em;
    line-height: 1.1em;
    padding: 6px 0;
    font-weight: normal;
    text-align: center;">Checkout</h2>
    </header>

    <div class="row1">
        <div class="col-75">
            <div class="container1">


                <div class="row1">
                    <div class="col-50">
                        <form method="post">
                            <h3>Billing Address
                                <?php
                                    if ($countbilladd > 0) {
                                        ?>
                                        <select style="font-size: small;width: 16%;" name="selid" id="selid">
                                            <option value="">Select</option>

                                            <?php
                                                while ($rowbilladd = mysqli_fetch_assoc($resbilladd)) {
                                                    ?>
                                                    <option value="<?php echo $rowbilladd['id']; ?>" <?php if ($rowbaddevbillingaddressidforuser['id'] == $rowbilladd['id']) {
                                                        echo 'selected';
                                                    } ?> ><?php echo $rowbilladd['addressprofilename'] . ": " . $rowbilladd['Address'] . ", " . $rowbilladd['City'] . ", " . $rowbilladd['State']; ?></option>
                                                    <?php
                                                }

                                            ?>
                                        </select><input type="submit" id="buttonbillingadd" name="buttonbillingadd"
                                                        hidden><?php } ?></h3>
                        </form>
                        <form method="post">

                            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                            <input type="text" id="fname" name="fullname" placeholder="John M. Doe"
                                   value="<?php echo $rowbaddevbillingaddressidforuser['fullname']; ?>" required>
                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                            <input type="text" id="email" name="email" placeholder="john@example.com"
                                   value="<?php echo $rowbaddevbillingaddressidforuser['Email']; ?>" required>
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street"
                                   value="<?php echo $rowbaddevbillingaddressidforuser['Address']; ?>" required>
                            <label for="city"><i class="fa fa-institution"></i> City</label>
                            <input type="text" id="city" name="city" placeholder="New York"
                                   value="<?php echo $rowbaddevbillingaddressidforuser['City']; ?>">

                            <div class="row">
                                <div class="col-50">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" placeholder="NY"
                                           value="<?php echo $rowbaddevbillingaddressidforuser['State']; ?>">
                                </div>
                                <div class="col-50">
                                    <label for="zip">Zip</label>
                                    <input type="text" id="zip" name="zip" placeholder="10001"
                                           value="<?php echo $rowbaddevbillingaddressidforuser['Zip']; ?>">
                                </div>
                            </div>
                    </div>

                    <div class="col-50">
                        <h3>Payment</h3>
                        <label for="fname">Accepted Cards</label>
                        <div class="icon-container1">
                            <i class="fa fa-cc-visa" style="color:navy;    width: 15%;"></i>
                            <i class="fa fa-cc-amex" style="color:blue;    width: 15%;"></i>
                            <i class="fa fa-cc-mastercard" style="color:red;    width: 15%;"></i>
                            <i class="fa fa-cc-discover" style="color:orange;    width: 15%;"></i>
                        </div>
                        <!-- <label for="cname">Name on Card</label> -->
                        <h4><input type="radio" id="cname" name="paytype" value="cos" class="radio4"> <b>Cash on
                                Service</b></h4><br>
                        <!--  <label for="ccnum">Credit card number</label> -->
                        <h4><input type="radio" id="ccnum" name="paytype" value="prep" class="radio4" checked> <b>Prepaid</b><sub>(Debit,
                                Credit Cards)</sub></h4>

                    </div>

                </div>
                <label>

                    <input type="checkbox" <?php if ($rowbaddevbillingaddressidforuser['id'] == "") {
                        echo 'checked="checked"';
                    } ?> name="sameadrchk" id="sameadrchk"> Service address same as billing
                </label>
                <input type="submit" value="Continue to checkout" name="checkoutbtn" class="btn" id="chkbtn">
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                <?php
                if($rowbaddevbillingaddressidforuser['id'] == "")
                {
                ?>
                $("#fname").val('<?php echo $rowprofile['Name']; ?>');
                $("#email").val('<?php echo $rowprofile['eMail']; ?>');
                $("#adr").val('<?php echo $rowprofile['Address']; ?>');
                $("#city").val('');
                $("#state").val('');
                $("#zip").val('');
                <?php
                }
                ?>
                $("#sameadrchk").click(function () {
                    if ($(this).prop("checked") == true) {
                        $("#fname").val('<?php echo $rowprofile['Name']; ?>');
                        $("#email").val('<?php echo $rowprofile['eMail']; ?>');
                        $("#adr").val('<?php echo $rowprofile['Address']; ?>');
                        $("#city").val('');
                        $("#state").val('');
                        $("#zip").val('');
                    } else {
                        $("#fname").val('');
                        $("#email").val('');
                        $("#adr").val('');
                        $("#city").val('');
                        $("#state").val('');
                        $("#zip").val('');
                    }


                });
            });
        </script>


        <div class="col-25">
            <div class="container1">
                <h4>Cart <span class="price" style="color:black"><i
                                class="fa fa-shopping-cart"></i> <b><?php echo $countallcart; ?></b></span></h4>
                <?php
                    while ($rowcountallcart = mysqli_fetch_assoc($rescountallcart)) {
                        $productidcart = $rowcountallcart['prdid'];
                        $sqlechprd = "SELECT * FROM `005_omgss_products` WHERE `id`='$productidcart'";
                        $resechprd = mysqli_query($conn, $sqlechprd);
                        $rowechprd = mysqli_fetch_assoc($resechprd);
                        $carttotal = $carttotal + $rowechprd['saleprice'];
                        $tax = (float)($carttotal * (18 / 100));
                        $carttotalwithtax = (float)($carttotal + $tax) - $_SESSION['coupdisc'];
                        ?>
                        <p>
                            <a href="viewproduct.php?prodid=<?php echo $rowechprd['id']; ?>"><?php echo $rowechprd['name']; ?></a>
                            <span class="price">Rs. <?php echo $rowechprd['saleprice']; ?></span></p>
                        <?php
                    }
                ?>


                <hr>
                <p>Total <span class="price" style="color:black"><b>Rs. <?php echo $carttotalwithtax; ?></b></span></p>
            </div>
        </div>
    </div>

    </body>
    </html>
    <script>

        $(document).ready(function () {
            $(".razorpay-payment-button").hide();
            $(".razorpay-payment-button").click();
            $("#selid").change(function () {
                $("#buttonbillingadd").click();
            });
        });
    </script>
<?php
    include('footer.php');
?>