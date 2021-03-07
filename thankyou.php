<?php
    include('header.php');
    if ($_SESSION["sessid"] == "") {
        echo '<script>window.location.href="index.php";</script>';
    }
?>
<?php

    $EmailBody = '<table border="0" cellpadding="0" cellspacing="10" height="100%" bgcolor="#FFFFFF" width="100%" style="max-width: 650px;" id="bodyTable">

          <tr>

              <td align="center" valign="top">

                  <table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailContainer" style="font-family:Arial; color: #333333;">

                      <!-- Logo -->

                      <tr>

                          <td align="left" valign="top" colspan="2" style="border-bottom: 1px solid #CCCCCC; padding-bottom: 10px;">

                              <img border="0" src="http://omgss.in/images/logo.png" title="Home" class="sitelogo" width="60%" style="max-width:250px;" />

                          </td>

                      </tr>

                      <!-- Title -->

                      <tr>

                          <td align="left" valign="top" colspan="2" style="border-bottom: 1px solid #CCCCCC; padding: 20px 0 10px 0;">

                              <span style="font-size: 18px; font-weight: normal;">A new Order Has Been Placed on OMGSS Website.</span>

                          </td>

                      </tr>

                      <!-- Messages -->

                      <tr>

                          <td align="left" valign="top" colspan="2" style="padding-top: 10px;">

                              <span style="font-size: 12px; line-height: 1; color: #333333;">

                                  Congratulations, Order ID : <b>OMGORD' . $_SESSION['lastid'] . '</b>

                                  <br /><br />

                                 
                                  

                              </span>

                          </td>

                      </tr>
                       <tr>

                          <td align="left" valign="top" colspan="2" style="border-bottom: 1px solid #CCCCCC; padding: 20px 0 10px 0;">

                              <span style="font-size: 18px; font-weight: normal;"></span>

                          </td>

                      </tr>
                       <tr>

                          <td align="left" valign="top" colspan="2" style="border-bottom: 1px solid #CCCCCC; padding: 20px 0 10px 0;">

                              <span style="font-size: 18px; font-weight: normal;"></span>

                          </td>

                      </tr>

                  </table>

              </td>

          </tr>

      </table>';
    $subject = "A new Order Has Been Placed";
    $alertmessage1 = "Message Sent";
    $alertmessage2 = "";
    $resultpdf = sendemail($companyEmail, "noreply@omgss.in", $subject, $EmailBody, $alertmessage1, $alertmessage2, "No");
    if ($_SESSION['paytype'] == "prep") {
        if ($_SESSION['paymentstatus'] == "Successful") {
            $odid = $_SESSION['lastid'];
            $razorpayid = $_SESSION['razorpay_payment_id'];
            mysqli_query($conn, "UPDATE `005_omgss_orders` SET `status`='Success',`razorpayid`='$razorpayid' WHERE `id`='$odid'");
            mysqli_query($conn, "DELETE FROM `005_omgss_cart` WHERE `ip`='$ip' OR `userid`='$loggeduserid'");
            $messnoti = "Your Order OMGORD" . $_SESSION['lastid'] . " has been received by us";
            mysqli_query($conn, "INSERT INTO `005_omgss_usernotifications`(`userid`,`image`,`content`)VALUES('$loggeduserid','pass.png','$messnoti')");

        }
    }

?>


    <style>
        @media (min-width: 1200px) {
            .container.bdy {
                max-width: 779px;
            }
        }

        .ftco-section {
            padding: 1em 0;
            position: relative;
        }

    </style>
    <section class="ftco-section bg-light">
        <div class="container bdy">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="wrapper">
                        <div class="row no-gutters">
                            <div class="col-md-12 d-flex">
                                <div class="contact-wrap w-100 p-md-5 p-4">
                                    <h2 class="mb-4" style="text-align: center;    margin-bottom: 0.5rem !important;">
                                        <b><?php if ($_SESSION['paytype'] == "cos") {
                                                echo 'Payment Successful';
                                            } else if ($_SESSION['paytype'] == "prep") {
                                                if ($_SESSION['paymentstatus'] == "Successful") {
                                                    echo 'Payment Successful';
                                                } else if ($_SESSION['paymentstatus'] == "Failure") {
                                                    echo 'Payment Failed';
                                                }
                                            } ?></b></h2>
                                    <form method="POST" id="contactForm" class="contactForm">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" style="text-align: center">
                                                    <i class="fa fa-check-circle" style="font-size: 333px;color:#60c878"
                                                       aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" style="text-align: center">
                                                    <?php if (($_SESSION['paytype'] == "cos") || (($_SESSION['paytype'] == "prep") && ($_SESSION['paymentstatus'] == "Successful"))) {
                                                        echo '<p>Your Order has been placed Successfully</p>';
                                                    } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" style="text-align: center">
                                                    <?php if ($_SESSION['paytype'] == "cos") {
                                                        echo '<p style="color:blue">Order ID : OMGORD' . $_SESSION['lastid'] . '</p>';
                                                    } else if ($_SESSION['paytype'] == "prep") {
                                                        if ($_SESSION['paymentstatus'] == "Successful") {
                                                            echo '<p style="color:blue">Transaction ID : ' . $_SESSION['razorpay_payment_id'] . '</p>';
                                                        } else {
                                                            echo '<p style="color:blue">Order ID : OMGORD' . $_SESSION['lastid'] . '</p>';
                                                        }
                                                    } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" style="text-align: center">
                                                    <?php if ($_SESSION['paytype'] == "prep") {
                                                        if ($_SESSION['paymentstatus'] == "Successful") {
                                                            echo '<p style="color:blue">Order ID : OMGORD' . $_SESSION['lastid'] . '</p>';
                                                        }
                                                    } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" style="text-align: center">
                                                    <a href="index.php" class="btn btn-primary">Continue Shopping</a>
                                                    <div class="submitting"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


<?php
    $_SESSION['coupidfrsv'] = "";
    $_SESSION['coupdisc'] = "";
    $_SESSION['disccouptypesh'] = "";
    $_SESSION['totalvalue'] = "";
    include('footer.php');
?>