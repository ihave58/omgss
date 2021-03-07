<?php
    session_start();
    $loggeduserid = $_SESSION["sessid"];
    include('../include/db.php');
    require('../razorpay/config.php');
    require('../razorpay/razorpay-php/Razorpay.php');

    use Razorpay\Api\Api;

    $id = runUserInputSanitizationHook($_GET['id']);

    $sql = "SELECT * FROM `005_omgss_orders` WHERE `id`='$id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    if ($row['userid'] != $loggeduserid) {
        echo '<script>window.location.href="../index.php";</script>';
        die;
    } else {
        if (($row['orderstate'] == "Delivered") || ($row['orderstate'] == "Cancelled")) {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	            
	                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

	                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


	                    <script>
	                    $( document ).ready(function() {
	                      var span = document.createElement("span");
	                        
	                     swal({
	                        title: "Something Went Wrong!!!",
	                        text: "Order Not Cancelled",
	                        icon: "error",
	                        closeOnClickOutside: false,
	                   }).then(function() {
                            window.location = "../myorders.php";
                        });
	            

	                    });
	                    $(document).on("click", "#btnA", function() {
	                        alert(this.id);
	                  });
	                   
	                  </script>
	                    ';
            die;
        } else {
            if ($row['paymenttype'] == "cos") {
                mysqli_query($conn, "UPDATE `005_omgss_orders` SET `orderstate`='Cancelled' WHERE `id`='$id'");
                $message = '<table border="0" cellpadding="0" cellspacing="10" height="100%" bgcolor="#FFFFFF" width="100%" style="max-width: 650px;" id="bodyTable">

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

		                              <span style="font-size: 18px; font-weight: normal;">Order Cancelled as per your request.</span>

		                          </td>

		                      </tr>

		                      <!-- Messages -->

		                      <tr>

		                          <td align="left" valign="top" colspan="2" style="padding-top: 10px;">

		                              <span style="font-size: 12px; line-height: 1; color: #333333;">

		                                  Order ID : <b>OMGORD' . $id . '</b>

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
                $sqlce = "SELECT * FROM `005_omgss_companydetails` WHERE `id`=1";
                $resce = mysqli_query($conn, $sqlce);
                $rowce = mysqli_fetch_assoc($resce);

                $to = $rowce['companyemail'];
                $subject = "Order OMGORD" . $id . " Cancelled as per your request.";
                $txt = $message;

                $headers = 'From: noreply@omgss.in' . "\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                $result = mail($to, $subject, $txt, $headers);
            } else if ($row['paymenttype'] == "prep") {
                $paymentid = $row['razorpayid'];
                try {
                    $api = new Api($keyId, $keySecret);
                    $refund = $api->refund->create(array('payment_id' => $paymentid));
                } catch (Exception $e) {
                    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	            
	                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

	                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


	                    <script>
	                    $( document ).ready(function() {
	                      var span = document.createElement("span");
	                        
	                     swal({
	                        title: "Something Went Wrong!!!",
	                        text: "Order Not Cancelled",
	                        icon: "error",
	                        closeOnClickOutside: false,
	                   }).then(function() {
                            window.location = "../myorders.php";
                        });
	            

	                    });
	                    $(document).on("click", "#btnA", function() {
	                        alert(this.id);
	                  });
	                   
	                  </script>
	                    ';
                    die;
                }
                $razorpayOrderId = $refund['id'];
                $razorpayamount = $refund['amount'] / 100;
                if ($razorpayOrderId) {
                    mysqli_query($conn, "UPDATE `005_omgss_orders` SET `orderstate`='Cancelled',`refundid`='$razorpayOrderId' WHERE `id`='$id'");

                    $message = '<table border="0" cellpadding="0" cellspacing="10" height="100%" bgcolor="#FFFFFF" width="100%" style="max-width: 650px;" id="bodyTable">

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

		                              <span style="font-size: 18px; font-weight: normal;">Order OMGORD' . $id . ' Cancelled as per your request.</span>

		                          </td>

		                      </tr>

		                      <!-- Messages -->

		                      <tr>

		                          <td align="left" valign="top" colspan="2" style="padding-top: 10px;">

		                              <span style="font-size: 12px; line-height: 1; color: #333333;">

		                                  Refund Transaction Id : <b>' . $razorpayOrderId . '</b>

		                                  <br /><br />

		                                  The refund amount Rs.' . $razorpayamount . ' will be credited in your bank account within 5-7 working days.
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
                    $sqlce = "SELECT * FROM `005_omgss_companydetails` WHERE `id`=1";
                    $resce = mysqli_query($conn, $sqlce);
                    $rowce = mysqli_fetch_assoc($resce);

                    $to = $rowce['companyemail'];
                    $subject = "Order OMGORD" . $id . " Cancelled as per your request.";
                    $txt = $message;

                    $headers = 'From: noreply@omgss.in' . "\r\n";
                    $headers .= "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    $result = mail($to, $subject, $txt, $headers);


                } else {
                    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	            
	                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

	                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


	                    <script>
	                    $( document ).ready(function() {
	                      var span = document.createElement("span");
	                        
	                     swal({
	                        title: "Something Went Wrong!!!",
	                        text: "Order Not Cancelled",
	                        icon: "error",
	                        closeOnClickOutside: false,
	                   }).then(function() {
                            window.location = "../myorders.php";
                        });
	            

	                    });
	                    $(document).on("click", "#btnA", function() {
	                        alert(this.id);
	                  });
	                   
	                  </script>
	                    ';
                    die;
                }


            }
        }

    }


    header("Location: ../myorders.php");

?>