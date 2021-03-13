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
        $pass = (isset($_POST['pass'])) ? runUserInputSanitizationHook($_POST['pass']) : '';
        $fname = (isset($_POST['fname'])) ? runUserInputSanitizationHook($_POST['fname']) : '';
        $lname = (isset($_POST['lname'])) ? runUserInputSanitizationHook($_POST['lname']) : '';
        $Phone = (isset($_POST['Phone'])) ? runUserInputSanitizationHook($_POST['Phone']) : '';
        $Address = (isset($_POST['Address'])) ? runUserInputSanitizationHook($_POST['Address']) : '';
        $Location = (isset($_POST['Location'])) ? runUserInputSanitizationHook($_POST['Location']) : '';


        if (empty($fname) || empty($lname) || empty($Phone) || empty($eMail) || empty($pass)) {
            $response = array('status' => 'error', 'message' => 'Input fields cannot be empty');
            echo json_encode($response);
            exit;
        }
        $name = $fname . " " . $lname;
        $passe = $pass;
        $pass = md5($pass);

        $sqlu = "SELECT * FROM `005_omgss_users` WHERE `eMail`='$eMail'";
        $resu = mysqli_query($conn, $sqlu);
        $countu = mysqli_num_rows($resu);
        if ($countu > 0) {
            $response = array('status' => 'error', 'message' => 'Email already Exists !!');
            echo json_encode($response);
        } else {
            mysqli_query($conn, "INSERT INTO `005_omgss_users`(`eMail`,`pass`,`Name`,`Phone`,`Address`,`Location`)VALUES('$eMail','$pass','$name','$Phone','$Address','$Location')");
            $lastid = mysqli_insert_id($conn);


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

                              <span style="font-size: 18px; font-weight: normal;">Thanks for Registering With Us.</span>

                          </td>

                      </tr>

                      <!-- Messages -->

                      <tr>

                          <td align="left" valign="top" colspan="2" style="padding-top: 10px;">

                              <span style="font-size: 12px; line-height: 1; color: #333333;">

                                  Your Username is <b>' . $eMail . '</b>

                                  <br /><br />

                                  Your Password is <b>' . $passe . '</b>

                                  <br /><br />

                                  For any queries you can contact us at http://www.omgss.in/contact.php

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

            $to = $eMail;
            $subject = "Thanks for Registering With Us. OMGSS Team.";
            $txt = $message;

            $headers = 'From: noreply@omgss.in' . "\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $result = mail($to, $subject, $txt, $headers);
            $getresult = "SELECT * FROM 005_omgss_users WHERE `id`='$lastid'";
            $results = $conn->query($getresult);
            $count = mysqli_num_rows($results);
            if ($count > 0) {
                $row = $results->fetch_assoc();
                $data['status'] = 'success';
                $data['result'] = array(
                    'id' => $row['id'],
                    'eMail' => $row['eMail'],
                    'Name' => $row['Name'],
                    'Phone' => $row['Phone'],
                    'Address' => $row['Address'],
                    'Location' => $row['Location'],
                    'datetime' => $row['datetime']


                );
                echo json_encode($data, JSON_NUMERIC_CHECK);
            }
        }


    } else {
        $response = array('status' => 'error', 'message' => 'This is a POST API. So please use POST Method.');
        echo json_encode($response);
    }

?>