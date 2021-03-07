<?php
    include_once('../../include/db.php');
    require('../../razorpay/config.php');
    require('../../razorpay/razorpay-php/Razorpay.php');

    use Razorpay\Api\Api;

    if (empty($_POST['appid'])) {
        echo $response = json_encode(array('status' => 'error', 'message' => "Appid Can't be Empty"));
        exit;
    }
    if (empty($_POST['token'])) {
        echo $response = json_encode(array('status' => 'error', 'message' => "Token Can't be Empty"));
        exit;
    } else {
        $urlid = $_POST['appid'];
        $urltoken = $_POST['token'];

        $sql1 = "SELECT id FROM 003_omgss_api_tokens WHERE app_id='" . $urlid . "' AND app_token='" . $urltoken . "'";
        $results = mysqli_query($conn, $sql1);
        $rowcount = mysqli_num_rows($results);
        if ($rowcount > 0) {
            $Data = mysqli_fetch_assoc($results);
            $UserId = $Data['id'];
        }

    }

    if (empty($UserId)) {
        $response = array('status' => 'error', 'message' => 'Invalid appid or token');
        echo json_encode($response);
        exit;
    }

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'POST') {

        $loggeduserid = (isset($_POST['loggeduserid'])) ? $_POST['loggeduserid'] : '';
        $id = (isset($_POST['orderid'])) ? $_POST['orderid'] : '';

        if ((empty($loggeduserid)) || (empty($id))) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }


        $sql = "SELECT * FROM `005_omgss_orders` WHERE `id`='$id'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
        } else {
            $response = array('status' => 'error', 'message' => 'No such Order Exists');
            echo json_encode($response);
            exit;
        }


        if ($row['userid'] != $loggeduserid) {
            $response = array('status' => 'error', 'message' => 'Sorry you are not authorized');
            echo json_encode($response);
            exit;
        } else {
            if (($row['orderstate'] == "Delivered") || ($row['orderstate'] == "Cancelled")) {
                $response = array('status' => 'error', 'message' => 'Sorry order not Cancelled');
                echo json_encode($response);
                exit;
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

                    $response = array('status' => 'success', 'message' => 'Order Cancelled Successfully');
                    echo json_encode($response);
                    exit;
                } else if ($row['paymenttype'] == "prep") {
                    $paymentid = $row['razorpayid'];

                    try {
                        $api = new Api($keyId, $keySecret);
                        $refund = $api->refund->create(array('payment_id' => $paymentid));
                    } catch (Exception $e) {
                        $response = array('status' => 'error', 'message' => 'Sorry order not Cancelled');
                        echo json_encode($response);
                        exit;
                    }
                    $razorpayOrderId = $refund['id'];


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

                        $response = array('status' => 'success', 'message' => 'Order Cancelled Successfully', 'refundid' => $razorpayOrderId);
                        echo json_encode($response);
                        exit;
                    } else {
                        $response = array('status' => 'error', 'message' => 'Sorry order not Cancelled');
                        echo json_encode($response);
                        exit;
                    }


                }
            }

        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>