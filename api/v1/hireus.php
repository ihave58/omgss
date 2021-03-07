<?php
    include_once('../../include/db.php');


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
        $service = (isset($_POST['service'])) ? $_POST['service'] : '';
        $name = (isset($_POST['name'])) ? $_POST['name'] : '';
        $phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
        $date = (isset($_POST['date'])) ? $_POST['date'] : '';
        $time = (isset($_POST['time'])) ? $_POST['time'] : '';
        $reason = (isset($_POST['reason'])) ? $_POST['reason'] : '';
        $message = (isset($_POST['message'])) ? $_POST['message'] : '';


        if (empty($name) || empty($phone) || empty($reason) || empty($message)) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }
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

                              <span style="font-size: 18px; font-weight: normal;">Hire Request Received From OMGSS Website.</span>

                          </td>

                      </tr>

                      <!-- Messages -->

                      <tr>

                          <td align="left" valign="top" colspan="2" style="padding-top: 10px;">

                              <span style="font-size: 12px; line-height: 1; color: #333333;">

                                  Service : <b>' . $service . '</b>

                                  <br /><br />

                                  Name : <b>' . $name . '</b>

                                  <br /><br />

                                  Phone : <b>' . $phone . '</b>

                                  <br /><br />

                                  Date : <b>' . $date . '</b>

                                  <br /><br />


                                  Time : <b>' . $time . '</b>

                                  <br /><br />


                                  Reason : <b>' . $reason . '</b>

                                  <br /><br />



                                  Message : <b>' . $message . '</b>

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
        $subject = "Hire Request Received From OMGSS Website.";
        $txt = $message;

        $headers = 'From: noreply@omgss.in' . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $result = mail($to, $subject, $txt, $headers);

        if (!$result) {
            $response = array('status' => 'error', 'message' => 'Message Could not be Sent. Please try again.');
            echo json_encode($response);

        } else {
            $response = array('status' => 'success', 'message' => 'Message Sent.');
            echo json_encode($response);
        }

    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>