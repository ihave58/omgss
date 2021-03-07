<?php

    if (isset($_POST['btnsublogin'])) {
        $username = runUserInputSanitizationHook($_POST['username']);
        $password = md5($_POST['password']);

        $sqllog = "SELECT * FROM `003_facerecog_admin` WHERE `username`='$username' AND `password`='$password'";
        $reslog = mysqli_query($conn, $sqllog);

        if (mysqli_num_rows($reslog) > 0) {
            $rowlog = mysqli_fetch_assoc($reslog);

            $_SESSION['idsessuser'] = $rowlog;
            header("Location: userstable.php");


        } else {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Incorrect Credentials!",
                        text: "",
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


    }

    if (isset($_POST['btnreset'])) {
        $opass = md5($_POST['opass']);
        $npass = md5($_POST['npass']);
        $cpass = md5($_POST['cpass']);

        if ($npass != $cpass) {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Passwords Donot Match!",
                        text: "",
                        icon: "error",
                        closeOnClickOutside: false,
                   })
            

                    });
                    $(document).on("click", "#btnA", function() {
                        alert(this.id);
                  });
                   
                  </script>
                    ';
        } else {

            $sqllog1 = "SELECT * FROM `003_facerecog_admin` WHERE `id`='1'";
            $reslog1 = mysqli_query($conn, $sqllog1);
            $rowlog1 = mysqli_fetch_assoc($reslog1);
            $odpass = $rowlog1['password'];
            if ($opass != $odpass) {
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                
                          <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                        <script>
                        $( document ).ready(function() {
                          var span = document.createElement("span");
                            
                         swal({
                            title: "Wrong Password!",
                            text: "",
                            icon: "error",
                            closeOnClickOutside: false,
                       })
                

                        });
                        $(document).on("click", "#btnA", function() {
                            alert(this.id);
                      });
                       
                      </script>
                        ';
            } else {
                $sqldel = "UPDATE `003_facerecog_admin` SET `password`='$npass' WHERE `id`=1";
                if ($conn->query($sqldel) === TRUE) {
                    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Password Changed Successfully!",
                        text: "",
                        icon: "success",
                        closeOnClickOutside: false,
                   }).then(function() {
                            window.location = "logout.php";
                        });

            

                    });
                    $(document).on("click", "#btnA", function() {
                        alert(this.id);
                  });
                   
                  </script>
                    ';
                } else {
                    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                
                          <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                        <script>
                        $( document ).ready(function() {
                          var span = document.createElement("span");
                            
                         swal({
                            title: "Something Went Wrong!",
                            text: "",
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
            }

        }


    }


    $sqlusers = "SELECT * FROM `003_facerecog_users` ORDER BY `id` DESC";
    $resusers = mysqli_query($conn, $sqlusers);
    $countusers = mysqli_num_rows($resusers);


    if (!empty($id)) {
        $sqlusersbyid = "SELECT * FROM `003_facerecog_users` WHERE `id`='$id'";
        $resusersbyid = mysqli_query($conn, $sqlusersbyid);
        $rowusersbyid = mysqli_fetch_assoc($resusersbyid);
    }

    if (!empty($rid)) {
        $sqlusersbyrid = "SELECT * FROM `003_facerecog_users` WHERE `id`='$rid'";
        $resusersbyrid = mysqli_query($conn, $sqlusersbyrid);
        $rowusersbyrid = mysqli_fetch_assoc($resusersbyrid);
        $awsfldr = $rowusersbyrid['awsfolder'];

        $sqllogs = "SELECT * FROM `facelogs` WHERE `externalid`='$awsfldr'";
        $reslogs = mysqli_query($conn1, $sqllogs);
        $countreports = mysqli_num_rows($reslogs);

    }


?>