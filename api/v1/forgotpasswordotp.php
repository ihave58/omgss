<?php
    include_once('../../include/db.php');
    require("../../include/utils.php");

    if (empty($_POST['appid'])) {
        echo $response = json_encode(array('status' => 'error', 'message' => "Appid Can't be Empty"));
        exit;
    }
    if (empty($_POST['token'])) {
        echo $response = json_encode(array('status' => 'error', 'message' => "Token Can't be Empty"));
        exit;
    } else {
        $urlid = runUserInputSanitizationHook($_POST['appid']);
        $urltoken = runUserInputSanitizationHook($_POST['token']);

        $sql1 = "SELECT user_id FROM 003_omgss_api_tokens WHERE app_id='" . $urlid . "' AND app_token='" . $urltoken . "'";
        $results = mysqli_query($conn, $sql1);
        $rowcount = mysqli_num_rows($results);
        if ($rowcount > 0) {
            $Data = mysqli_fetch_assoc($results);
            $UserId = $Data['user_id'];
        }

    }

    if (empty($UserId)) {
        $response = array('status' => 'error', 'message' => 'Invalid appid or token');
        echo json_encode($response);
        exit;
    }

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'POST') {
        $eMail = (isset($_POST['eMail'])) ? runUserInputSanitizationHook($_POST['eMail']) : '';


        if (empty($eMail)) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }


        $sqluser = "SELECT * FROM `005_omgss_users` WHERE `eMail`='$eMail'";
        $resuser = mysqli_query($conn, $sqluser);
        if (mysqli_num_rows($resuser) > 0) {
            $rowuser = mysqli_fetch_assoc($resuser);
            $resetotp = rand(1000, 9999);
            $usridshow = $rowuser['id'];

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

                                <span style="font-size: 18px; font-weight: normal;">Reset Password Email.</span>

                            </td>

                        </tr>

                        <!-- Messages -->

                        <tr>

                            <td align="left" valign="top" colspan="2" style="padding-top: 10px;">

                                <span style="font-size: 12px; line-height: 1; color: #333333;">

                                    Your password reset OTP is : <b>' . $resetotp . '</b>

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

            $to = $rowuser['eMail'];
            $subject = "Reset Password Email.";
            $txt = $message;

            $headers = 'From: noreply@omgss.in' . "\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $result = mail($to, $subject, $txt, $headers);

            if (!$result) {
                $response = array('status' => 'error', 'message' => 'Message Could not be Sent. Please try again.');
                echo json_encode($response);

            } else {
                $response = array('status' => 'success', 'userid' => $usridshow, 'OTP' => $resetotp, 'message' => 'Message Sent.');
                echo json_encode($response);
            }
        } else {
            $response = array('status' => 'error', 'message' => 'This Email Doesnot Exist.');
            echo json_encode($response);
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>