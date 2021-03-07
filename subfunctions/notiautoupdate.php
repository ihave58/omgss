<?php
    session_start();
    error_reporting(0);
    include('../include/db.php');
    if (isset($_POST['action']) && runUserInputSanitizationHook($_POST['action']) == 'alertquerynoti2autoupdate') {


        $userid = runUserInputSanitizationHook($_POST['userid']);
        echo '<form  class="form-container" >';
        $sqlnotiuserfr = "SELECT * FROM `005_omgss_usernotifications` WHERE `userid`='$userid' ORDER BY `id` DESC LIMIT 20";
        $resnotiuserfr = mysqli_query($conn, $sqlnotiuserfr);
        $countnotiuserfr = mysqli_num_rows($resnotiuserfr);
        if ($countnotiuserfr > 0) {
            echo '<table>
		    	<tbody>';

            while ($rownotiuserfr = mysqli_fetch_assoc($resnotiuserfr)) {

                $notitypechk = $rownotiuserfr['notificationid'];
                if ($notitypechk == "system") {
                    echo '<tr>
						    			<td><img src="images/' . $rownotiuserfr['image'] . '" style="height:50px;width:50px"></td>
						    			<td>' . substr(strip_tags($rownotiuserfr['content']), 0, 1000) . '</td>
					    			</tr>';
                } else {
                    $sqlnotifromtb = "SELECT * FROM `005_omgss_notifications` WHERE `id`='$notitypechk'";
                    $resnotifromtb = mysqli_query($conn, $sqlnotifromtb);
                    $rownotifromtb = mysqli_fetch_assoc($resnotifromtb);
                    echo '<tr>
						    			<td><img src="admin/files/noti/' . $rownotifromtb['image'] . '" style="height:50px;width:50px"></td>
						    			<td>' . substr(strip_tags($rownotifromtb['description']), 0, 1000) . '</td>
					    			</tr>';
                }


            }
            echo '</tbody>
		    </table>';


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


        echo '</form>';


    }
?>