<?php
    require("utils.php");

    function createThumb($path1, $path2, $file_type, $new_w, $new_h, $squareSize = '')
    {
        /* read the source image */
        $source_image = FALSE;

        if (preg_match("/jpg|JPG|jpeg|JPEG/", $file_type)) {
            $source_image = imagecreatefromjpeg($path1);
        } elseif (preg_match("/png|PNG/", $file_type)) {

            if (!$source_image = @imagecreatefrompng($path1)) {
                $source_image = imagecreatefromjpeg($path1);
            }
        } elseif (preg_match("/gif|GIF/", $file_type)) {
            $source_image = imagecreatefromgif($path1);
        }
        if ($source_image == FALSE) {
            $source_image = imagecreatefromjpeg($path1);
        }

        $orig_w = imageSX($source_image);
        $orig_h = imageSY($source_image);

        if ($orig_w < $new_w && $orig_h < $new_h) {
            $desired_width = $orig_w;
            $desired_height = $orig_h;
        } else {
            $scale = min($new_w / $orig_w, $new_h / $orig_h);
            $desired_width = ceil($scale * $orig_w);
            $desired_height = ceil($scale * $orig_h);
        }

        if ($squareSize != '') {
            $desired_width = $desired_height = $squareSize;
        }

        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
        // for PNG background white----------->
        $kek = imagecolorallocate($virtual_image, 255, 255, 255);
        imagefill($virtual_image, 0, 0, $kek);

        if ($squareSize == '') {
            /* copy source image at a resized size */
            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $orig_w, $orig_h);
        } else {
            $wm = $orig_w / $squareSize;
            $hm = $orig_h / $squareSize;
            $h_height = $squareSize / 2;
            $w_height = $squareSize / 2;

            if ($orig_w > $orig_h) {
                $adjusted_width = $orig_w / $hm;
                $half_width = $adjusted_width / 2;
                $int_width = $half_width - $w_height;
                imagecopyresampled($virtual_image, $source_image, -$int_width, 0, 0, 0, $adjusted_width, $squareSize, $orig_w, $orig_h);
            } elseif (($orig_w <= $orig_h)) {
                $adjusted_height = $orig_h / $wm;
                $half_height = $adjusted_height / 2;
                imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $squareSize, $adjusted_height, $orig_w, $orig_h);
            } else {
                imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $squareSize, $squareSize, $orig_w, $orig_h);
            }
        }

        if (@imagejpeg($virtual_image, $path2, 90)) {
            imagedestroy($virtual_image);
            imagedestroy($source_image);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    ini_set("memory_limit", "99M");
    ini_set('post_max_size', '20M');
    ini_set('max_execution_time', 600);


    $loggeduserid = $_SESSION["sessid"];
    if (isset($_POST['changeordst'])) {
        $ordid = runUserInputSanitizationHook($_POST['ordid']);
        $orderst = runUserInputSanitizationHook($_POST['orderst']);
        $sqlgetprdord = "SELECT * FROM `005_omgss_orders` WHERE `id`='$ordid'";
        $resgetprdord = mysqli_query($conn, $sqlgetprdord);
        $rowgetprdord = mysqli_fetch_assoc($resgetprdord);
        $getudet = $rowgetprdord['userid'];
        if ($orderst == "Delivered") {
            $sqlchkdevreg = "SELECT * FROM `003_omgss_devices` WHERE `orderid`='$ordid'";
            $reschkdevreg = mysqli_query($conn, $sqlchkdevreg);
            $countchkdevreg = mysqli_num_rows($reschkdevreg);
            if ($countchkdevreg > 0) {

            } else {

                $getorddet = $rowgetprdord['orderdetails'];
                $getorddetjson = json_decode($getorddet);
                foreach ($getorddetjson as $itmjson) {
                    $orddetprdidjson = $itmjson->productid;
                    $orddetqntyjson = $itmjson->quantity;

                    $sqlorddetprdidjson = "SELECT * FROM `005_omgss_products` WHERE `id`='$orddetprdidjson'";
                    $resorddetprdidjson = mysqli_query($conn, $sqlorddetprdidjson);
                    $roworddetprdidjson = mysqli_fetch_assoc($resorddetprdidjson);

                    $maintainancetypejson = $roworddetprdidjson['maintenancetype'];
                    if ($maintainancetypejson == 2) {
                        mysqli_query($conn, "INSERT INTO `003_omgss_devices`(`userid`,`productid`,`quantity`,`orderid`)VALUES('$getudet','$orddetprdidjson','$orddetqntyjson','$ordid')");
                        $messnoti = "Product " . $roworddetprdidjson['name'] . " from Order OMGORD" . $ordid . " has been added to annual maintenance. Please check My Devices";
                        mysqli_query($conn, "INSERT INTO `005_omgss_usernotifications`(`userid`,`image`,`content`)VALUES('$getudet','pass.png','$messnoti')");
                    }


                }

            }
        } else {
            mysqli_query($conn, "DELETE FROM `003_omgss_devices` WHERE `orderid`='$ordid'");
        }

        mysqli_query($conn, "UPDATE `005_omgss_orders` SET `orderstate`='$orderst' WHERE `id`='$ordid'");
        if ($orderst != "Received") {
            if ($orderst == "Delivered") {
                $messnoti = "Your Order OMGORD" . $ordid . " has been marked " . $orderst . ". Thank You for shopping with Us.";
            } else {
                $messnoti = "Your Order OMGORD" . $ordid . " has been marked " . $orderst;
            }

            mysqli_query($conn, "INSERT INTO `005_omgss_usernotifications`(`userid`,`image`,`content`)VALUES('$getudet','pass.png','$messnoti')");
        }


    }


    if ($_SESSION["redirecturi"] == "") {
        $_SESSION["redirecturi"] = "myaccount.php";
    }


    if (isset($_POST['btnsublogin'])) {
        $username = runUserInputSanitizationHook($_POST['username']);
        $password = md5($_POST['password']);

        $sqllog = "SELECT * FROM `005_omgss_admin` WHERE `username`='$username' AND `password`='$password'";
        $reslog = mysqli_query($conn, $sqllog);

        if (mysqli_num_rows($reslog) > 0) {
            $rowlog = mysqli_fetch_assoc($reslog);

            $_SESSION['idsessuser'] = $rowlog;
            header("Location: categories.php");


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


    if (isset($_POST['addcat'])) {
        $categoryname = runUserInputSanitizationHook($_POST['categoryname']);


        $sqllog = "SELECT * FROM `005_omgss_categories` WHERE `name`='$categoryname'";
        $reslog = mysqli_query($conn, $sqllog);

        if (mysqli_num_rows($reslog) > 0) {

            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Category Already Exists !!!",
                        text: "",
                        icon: "info",
                        closeOnClickOutside: false,
                   })
            

                    });
                    $(document).on("click", "#btnA", function() {
                        alert(this.id);
                  });
                   
                  </script>
                    ';


        } else {

            mysqli_query($conn, "INSERT INTO `005_omgss_categories`(`name`) VALUES ('$categoryname')");
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Category Added Successfully !!!",
                        text: "",
                        icon: "success",
                        closeOnClickOutside: false,
                   }).then(function() {
                            window.location = "categories.php";
                        });
            

                    });
                    $(document).on("click", "#btnA", function() {
                        alert(this.id);
                  });
                   
                  </script>
                    ';

        }


    }


    $sqlcat = "SELECT * FROM `005_omgss_categories`";
    $rescat = mysqli_query($conn, $sqlcat);
    $countcat = mysqli_num_rows($rescat);

    $sqlcath = "SELECT * FROM `005_omgss_categories`";
    $rescath = mysqli_query($conn, $sqlcath);
    $countcath = mysqli_num_rows($rescath);

    $sqlcath1 = "SELECT * FROM `005_omgss_categories`";
    $rescath1 = mysqli_query($conn, $sqlcath1);
    $countcath1 = mysqli_num_rows($rescath1);

    $catid = runUserInputSanitizationHook($_GET['catid']);
    if ($catid) {
        $sqlcatname = "SELECT * FROM `005_omgss_categories` WHERE `id`='$catid'";
        $rescatname = mysqli_query($conn, $sqlcatname);
        $rowcatname = mysqli_fetch_assoc($rescatname);

        $sqlsubcats = "SELECT * FROM `005_omgss_subcategories` WHERE `catid`='$catid'";
        $ressubcats = mysqli_query($conn, $sqlsubcats);
        $countsubcats = mysqli_num_rows($ressubcats);
    }

    $catgoryid = runUserInputSanitizationHook($_GET['catgoryid']);

    if (isset($_POST['addsubcat'])) {
        $goterror = 0;
        $subcategoryname = runUserInputSanitizationHook($_POST['subcategoryname']);
        $image = md5(date("Y-m-d") . date("h:i:sa") . $_FILES["categoryimg"]["name"]);
        $extensionimage = end(explode(".", $_FILES["categoryimg"]["name"]));
        $finalimagename = $image . "." . $extensionimage;
        $filepathimage = "files/sub/" . $image . "." . $extensionimage;
        /*$categoryimg = runUserInputSanitizationHook($_POST['categoryimg']);*/

        if (move_uploaded_file($_FILES["categoryimg"]["tmp_name"], $filepathimage)) {

        } else {
            $goterror = 1;
            echo '
	          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	            <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
	            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	          <script>
	            $( document ).ready(function() {
	               swal({
	            title: "Error Uploading Image!",
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
        $catid = runUserInputSanitizationHook($_POST['catid']);

        if ($goterror == 0) {
            $sqllog = "SELECT * FROM `005_omgss_subcategories` WHERE `subcatnamev`='$subcategoryname'";
            $reslog = mysqli_query($conn, $sqllog);

            if (mysqli_num_rows($reslog) > 0) {

                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	            
	                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

	                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


	                    <script>
	                    $( document ).ready(function() {
	                      var span = document.createElement("span");
	                        
	                     swal({
	                        title: "Sub Category Already Exists !!!",
	                        text: "",
	                        icon: "info",
	                        closeOnClickOutside: false,
	                   })
	            

	                    });
	                    $(document).on("click", "#btnA", function() {
	                        alert(this.id);
	                  });
	                   
	                  </script>
	                    ';


            } else {

                mysqli_query($conn, "INSERT INTO `005_omgss_subcategories`(`subcatname`,`subcatimage`,`catid`) VALUES ('$subcategoryname','$finalimagename','$catid')");
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	            
	                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

	                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


	                    <script>
	                    $( document ).ready(function() {
	                      var span = document.createElement("span");
	                        
	                     swal({
	                        title: "Sub Category Added Successfully !!!",
	                        text: "",
	                        icon: "success",
	                        closeOnClickOutside: false,
	                   }).then(function() {
	                            window.location = "subcategories.php?catid=' . $catid . '";
	                        });
	            

	                    });
	                    $(document).on("click", "#btnA", function() {
	                        alert(this.id);
	                  });
	                   
	                  </script>
	                    ';

            }
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

            $sqllog1 = "SELECT * FROM `005_omgss_admin` WHERE `id`='1'";
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
                $sqldel = "UPDATE `005_omgss_admin` SET `password`='$npass' WHERE `id`=1";
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


    if (isset($_POST['addprod'])) {
        $goterror = 0;
        $productname = runUserInputSanitizationHook($_POST['productname']);
        $tags = runUserInputSanitizationHook($_POST['tags']);
        $maintenancetype = runUserInputSanitizationHook($_POST['maintenancetype']);
        $category = runUserInputSanitizationHook($_POST['category']);
        $units = runUserInputSanitizationHook($_POST['units']);
        $subcategory = runUserInputSanitizationHook($_POST['subcategory']);
        $image = md5(date("Y-m-d") . date("h:i:sa") . $_FILES["productimage"]["name"]);
        $extensionimage = end(explode(".", $_FILES["productimage"]["name"]));
        $finalimagename = $image . "." . $extensionimage;
        $filepathimage = "files/prod/" . $image . "." . $extensionimage;
        /*$categoryimg = runUserInputSanitizationHook($_POST['categoryimg']);*/

        if (move_uploaded_file($_FILES["productimage"]["tmp_name"], $filepathimage)) {

        } else {
            $goterror = 1;
            echo '
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
              <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script>
              $( document ).ready(function() {
                 swal({
              title: "Error Uploading Image!",
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
        $thumbname = "thmb" . $finalimagename;
        if (createThumb($filepathimage, "./files/thumbnails/" . $thumbname, $extensionimage, 300, 200)) {


        } else {
            $goterror = 1;
            echo '
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
              <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script>
              $( document ).ready(function() {
                 swal({
              title: "Error Uploading Thumbnail!",
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
        $saleprice = runUserInputSanitizationHook($_POST['saleprice']);
        $actualprice = runUserInputSanitizationHook($_POST['actualprice']);
        $description = runUserInputSanitizationHook($_POST['description']);

        if ($goterror == 0) {

            mysqli_query($conn, "INSERT INTO `005_omgss_products`(`name`,`categoryid`,`subcategoryid`,`image`,`units`,`saleprice`,`actualprice`,`description`,`maintenancetype`,`tags`,`thumbnail`) VALUES ('$productname','$category','$subcategory','$finalimagename','$units','$saleprice','$actualprice','$description','$maintenancetype','$tags','$thumbname')");
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "Product Added Successfully !!!",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "products.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';


        }


    }

    $sqlprod = "SELECT * FROM `005_omgss_products` ORDER BY `id` DESC";
    $resprod = mysqli_query($conn, $sqlprod);
    $countprod = mysqli_num_rows($resprod);


    if (isset($_POST['contactdetailsbtn'])) {
        $address = runUserInputSanitizationHook($_POST['address']);
        $phone = runUserInputSanitizationHook($_POST['phone']);
        $officetiming = runUserInputSanitizationHook($_POST['officetiming']);
        $email = runUserInputSanitizationHook($_POST['email']);
        $website = runUserInputSanitizationHook($_POST['website']);


        mysqli_query($conn, "UPDATE `005_omgss_contactdetails` SET `address`='$address',`phone`='$phone',`officetiming`='$officetiming',`email`='$email',`website`='$website' WHERE `id`=1");
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "Contact Details Updated Successfully !!!",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "contactdetails.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';


    }

    $sqlcontact = "SELECT * FROM `005_omgss_contactdetails`";
    $rescontact = mysqli_query($conn, $sqlcontact);
    $rowcontact = mysqli_fetch_assoc($rescontact);


    if (isset($_POST['termsbtn'])) {
        if ($_FILES["image"]["name"] != "") {
            $image = md5(date("Y-m-d") . date("h:i:sa") . $_FILES["image"]["name"]);
            $extensionimage = end(explode(".", $_FILES["image"]["name"]));
            $finalimagename = $image . "." . $extensionimage;
            $filepathimage = "files/extras/" . $image . "." . $extensionimage;

            $goterror = 0;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $filepathimage)) {

            } else {
                $goterror = 1;
                echo '
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
             <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
             <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
             <script>
                    $( document ).ready(function() {
                       swal({
                    title: "Error Uploading Image!",
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


            if ($goterror == 0) {
                $textterms = runUserInputSanitizationHook($_POST['textterms']);

                mysqli_query($conn, "UPDATE `005_omgss_termsandconditions` SET `image`='$finalimagename',`textterms`='$textterms' WHERE `id`=1");
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "Terms and Conditions Updated Successfully !!!",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "termsandconditions.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';
            }
        } else {

            $textterms = runUserInputSanitizationHook($_POST['textterms']);

            mysqli_query($conn, "UPDATE `005_omgss_termsandconditions` SET `textterms`='$textterms' WHERE `id`=1");
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "Terms and Conditions Updated Successfully !!!",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "termsandconditions.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';


        }


    }

    $sqlterms = "SELECT * FROM `005_omgss_termsandconditions`";
    $resterms = mysqli_query($conn, $sqlterms);
    $rowterms = mysqli_fetch_assoc($resterms);


    if (isset($_POST['aboutbtn'])) {
        if ($_FILES["image"]["name"] != "") {
            $image = md5(date("Y-m-d") . date("h:i:sa") . $_FILES["image"]["name"]);
            $extensionimage = end(explode(".", $_FILES["image"]["name"]));
            $finalimagename = $image . "." . $extensionimage;
            $filepathimage = "files/extras/" . $image . "." . $extensionimage;

            $goterror = 0;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $filepathimage)) {

            } else {
                $goterror = 1;
                echo '
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
             <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
             <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
             <script>
                    $( document ).ready(function() {
                       swal({
                    title: "Error Uploading Image!",
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


            if ($goterror == 0) {
                $textterms = runUserInputSanitizationHook($_POST['textterms']);

                mysqli_query($conn, "UPDATE `005_omgss_aboutus` SET `image`='$finalimagename',`textterms`='$textterms' WHERE `id`=1");
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "About Us Updated Successfully !!!",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "aboutus.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';
            }
        } else {

            $textterms = runUserInputSanitizationHook($_POST['textterms']);

            mysqli_query($conn, "UPDATE `005_omgss_aboutus` SET `textterms`='$textterms' WHERE `id`=1");
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "About Us Updated Successfully !!!",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "aboutus.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';


        }


    }


    $sqlabout = "SELECT * FROM `005_omgss_aboutus`";
    $resabout = mysqli_query($conn, $sqlabout);
    $rowabout = mysqli_fetch_assoc($resabout);


    if (isset($_POST['addfaq'])) {
        $question = runUserInputSanitizationHook($_POST['question']);
        $answer = runUserInputSanitizationHook($_POST['answer']);

        mysqli_query($conn, "INSERT INTO `005_omgss_faq` (`question`,`answer`) VALUES ('$question','$answer')");
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "FAQ Inserted Successfully !!!",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "faq.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';


    }

    $sqlfaq = "SELECT * FROM `005_omgss_faq`";
    $resfaq = mysqli_query($conn, $sqlfaq);
    $countfaq = mysqli_num_rows($resfaq);


    if (isset($_POST['addfaqbanner'])) {

        $image = md5(date("Y-m-d") . date("h:i:sa") . $_FILES["bannerimage"]["name"]);
        $extensionimage = end(explode(".", $_FILES["bannerimage"]["name"]));
        $finalimagename = $image . "." . $extensionimage;
        $filepathimage = "files/extras/" . $image . "." . $extensionimage;

        $goterror = 0;
        if (move_uploaded_file($_FILES["bannerimage"]["tmp_name"], $filepathimage)) {

        } else {
            $goterror = 1;
            echo '
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
             <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
             <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
             <script>
                    $( document ).ready(function() {
                       swal({
                    title: "Error Uploading Image!",
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


        if ($goterror == 0) {


            mysqli_query($conn, "UPDATE `005_omgss_faqbanner` SET `faqbanner`='$finalimagename' WHERE `id`=1");
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "FAQ Banner Updated Successfully !!!",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "faq.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';
        }


    }

    $sqlfaqbanner = "SELECT * FROM `005_omgss_faqbanner`";
    $resfaqbanner = mysqli_query($conn, $sqlfaqbanner);
    $rowfaqbanner = mysqli_fetch_assoc($resfaqbanner);


    if (isset($_POST['privacybtn'])) {
        if ($_FILES["image"]["name"] != "") {
            $image = md5(date("Y-m-d") . date("h:i:sa") . $_FILES["image"]["name"]);
            $extensionimage = end(explode(".", $_FILES["image"]["name"]));
            $finalimagename = $image . "." . $extensionimage;
            $filepathimage = "files/extras/" . $image . "." . $extensionimage;

            $goterror = 0;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $filepathimage)) {

            } else {
                $goterror = 1;
                echo '
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
             <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
             <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
             <script>
                    $( document ).ready(function() {
                       swal({
                    title: "Error Uploading Image!",
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


            if ($goterror == 0) {
                $textterms = runUserInputSanitizationHook($_POST['textterms']);

                mysqli_query($conn, "UPDATE `005_omgss_privacypolicy` SET `image`='$finalimagename',`textterms`='$textterms' WHERE `id`=1");
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "Privacy Policy Updated Successfully !!!",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "privacypolicy.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';
            }
        } else {

            $textterms = runUserInputSanitizationHook($_POST['textterms']);

            mysqli_query($conn, "UPDATE `005_omgss_privacypolicy` SET `textterms`='$textterms' WHERE `id`=1");
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "Privacy Policy Updated Successfully !!!",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "privacypolicy.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';


        }


    }

    $sqlprivacy = "SELECT * FROM `005_omgss_privacypolicy`";
    $resprivacy = mysqli_query($conn, $sqlprivacy);
    $rowprivacy = mysqli_fetch_assoc($resprivacy);


    $scatid = runUserInputSanitizationHook($_GET['scatid']);
    if ($scatid) {
        $sqlsubcatsm = "SELECT * FROM `005_omgss_subcategories` WHERE `id`='$scatid'";
        $ressubcatsm = mysqli_query($conn, $sqlsubcatsm);
        $rowsubcatsm = mysqli_fetch_assoc($ressubcatsm);

        $sqlsubcatsmprod = "SELECT * FROM `005_omgss_products` WHERE `subcategoryid`='$scatid'";
        $ressubcatsmprod = mysqli_query($conn, $sqlsubcatsmprod);
        $countsubcatsmprod = mysqli_num_rows($ressubcatsmprod);

    }

    /*Careers Email Code*/
    if (isset($_POST['btnCareer'])) {
        $name = runUserInputSanitizationHook($_REQUEST['name']);
        $phoneno = runUserInputSanitizationHook($_REQUEST['phoneno']);
        $email = runUserInputSanitizationHook($_REQUEST['email']);
        $education = runUserInputSanitizationHook($_REQUEST['education']);
        $address = runUserInputSanitizationHook($_REQUEST['address']);
        $workexp = runUserInputSanitizationHook($_REQUEST['workexp']);
        $prevsal = runUserInputSanitizationHook($_REQUEST['prevsal']);
        $expsal = runUserInputSanitizationHook($_REQUEST['expsal']);
        $message = runUserInputSanitizationHook($_REQUEST['message']);


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

                              <span style="font-size: 18px; font-weight: normal;">Career Apply From OMGSS Website.</span>

                          </td>

                      </tr>

                      <!-- Messages -->

                      <tr>

                          <td align="left" valign="top" colspan="2" style="padding-top: 10px;">

                              <span style="font-size: 12px; line-height: 1; color: #333333;">

                                  Name : <b>' . $name . '</b>

                                  <br /><br />

                                  Phone : <b>' . $phoneno . '</b>

                                  <br /><br />

                                  Email : <b>' . $email . '</b>

                                  <br /><br />

                                  Education Qualification : <b>' . $education . '</b>

                                  <br /><br />

                                  Address : <b>' . $address . '</b>

                                  <br /><br />

                                  Work Experience : <b>' . $workexp . '</b>

                                  <br /><br />

                                  Previous Salary : <b>' . $prevsal . '</b>

                                  <br /><br />

                                  Expected Salary : <b>' . $expsal . '</b>

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
        $subject = "Career Apply From OMGSS Website";
        $alertmessage1 = "Message Sent";
        $alertmessage2 = "";
        $resultpdf = sendemail($companyEmail, "noreply@omgss.in", $subject, $EmailBody, $alertmessage1, $alertmessage2, "Yes");


    }
    /*Complain Email Code*/
    if (isset($_POST['btnComplain'])) {
        $name = runUserInputSanitizationHook($_REQUEST['name']);
        $contactno = runUserInputSanitizationHook($_REQUEST['contactno']);
        $email = runUserInputSanitizationHook($_REQUEST['email']);
        $address = runUserInputSanitizationHook($_REQUEST['address']);
        $complainDetails = runUserInputSanitizationHook($_REQUEST['complainDetails']);
        $message = runUserInputSanitizationHook($_REQUEST['message']);

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

                              <span style="font-size: 18px; font-weight: normal;">Complain Received From OMGSS Website.</span>

                          </td>

                      </tr>

                      <!-- Messages -->

                      <tr>

                          <td align="left" valign="top" colspan="2" style="padding-top: 10px;">

                              <span style="font-size: 12px; line-height: 1; color: #333333;">

                                  Name : <b>' . $name . '</b>

                                  <br /><br />

                                  Phone : <b>' . $contactno . '</b>

                                  <br /><br />

                                  Email : <b>' . $email . '</b>

                                  <br /><br />

                                  Address : <b>' . $address . '</b>

                                  <br /><br />

                                  Complain Details : <b>' . $complainDetails . '</b>

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
        $subject = "Complain Received From OMGSS Website";
        $alertmessage1 = "Message Sent";
        $alertmessage2 = "";
        $resultpdf = sendemail($companyEmail, "noreply@omgss.in", $subject, $EmailBody, $alertmessage1, $alertmessage2, "Yes");


    }
    /*Complain Email Code*/
    if (isset($_POST['btnHire'])) {
        $service = runUserInputSanitizationHook($_REQUEST['service']);
        $name = runUserInputSanitizationHook($_REQUEST['name']);
        $phoneno = runUserInputSanitizationHook($_REQUEST['phoneno']);
        $date = runUserInputSanitizationHook($_REQUEST['date']);
        $time = runUserInputSanitizationHook($_REQUEST['time']);
        $reason = runUserInputSanitizationHook($_REQUEST['reason']);
        $message = runUserInputSanitizationHook($_REQUEST['message']);


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

                                  Phone : <b>' . $phoneno . '</b>

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
        $subject = "Hire Request Received From OMGSS Website";
        $alertmessage1 = "Message Sent";
        $alertmessage2 = "";
        $resultpdf = sendemail($companyEmail, "noreply@omgss.in", $subject, $EmailBody, $alertmessage1, $alertmessage2, "Yes");


    }

    /*Contact Email Code*/
    if (isset($_POST['btnContact'])) {
        $name = runUserInputSanitizationHook($_REQUEST['name']);
        $email = runUserInputSanitizationHook($_REQUEST['email']);
        $subject = runUserInputSanitizationHook($_REQUEST['subject']);
        $message = runUserInputSanitizationHook($_REQUEST['message']);


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

                              <span style="font-size: 18px; font-weight: normal;">Contact Received From OMGSS Website.</span>

                          </td>

                      </tr>

                      <!-- Messages -->

                      <tr>

                          <td align="left" valign="top" colspan="2" style="padding-top: 10px;">

                              <span style="font-size: 12px; line-height: 1; color: #333333;">

                                  Name : <b>' . $name . '</b>

                                  <br /><br />

                                  Email : <b>' . $email . '</b>

                                  <br /><br />

                                  Subject : <b>' . $subject . '</b>

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
        $subject = "Contact Received From OMGSS Website";
        $alertmessage1 = "Message Sent";
        $alertmessage2 = "";
        $resultpdf = sendemail($companyEmail, "noreply@omgss.in", $subject, $EmailBody, $alertmessage1, $alertmessage2, "Yes");


    }


    $prodid = runUserInputSanitizationHook($_GET['prodid']);
    if ($prodid) {
        $sqlviewprod = "SELECT * FROM `005_omgss_products` WHERE `id`='$prodid'";
        $resviewprod = mysqli_query($conn, $sqlviewprod);
        $rowviewprod = mysqli_fetch_assoc($resviewprod);
    }


    if (isset($_POST['registerbtn'])) {
        $eMail = runUserInputSanitizationHook($_REQUEST['eMail']);
        $pass = md5($_REQUEST['pass']);
        $passe = runUserInputSanitizationHook($_REQUEST['pass']);

        $Name = runUserInputSanitizationHook($_REQUEST['Name']);
        $Phone = runUserInputSanitizationHook($_REQUEST['Phone']);
        $Address = runUserInputSanitizationHook($_REQUEST['Address']);
        $Location = runUserInputSanitizationHook($_REQUEST['Location']);

        $sqlchk = "SELECT * FROM `005_omgss_users` WHERE `eMail`='$eMail'";
        $reschk = mysqli_query($conn, $sqlchk);
        if (mysqli_num_rows($reschk) > 0) {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Email Already Exists !!!",
                        text: "",
                        icon: "info",
                        closeOnClickOutside: false,
                   })
            

                    });
                    $(document).on("click", "#btnA", function() {
                        alert(this.id);
                  });
                   
                  </script>
                    ';
        } else {
            $subject = "Thanks for Registering With Us. OMGSS Team.";

            $alertmessage1 = "";
            $alertmessage2 = "";
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
            $resultpdf = sendemail($eMail, "noreply@omgss.in", $subject, $message, $alertmessage1, $alertmessage2, "No");
            mysqli_query($conn, "INSERT INTO `005_omgss_users`(`eMail`,`pass`,`Name`,`Phone`,`Address`,`Location`)VALUES('$eMail','$pass','$Name','$Phone','$Address','$Location')");
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Registered Successfully !!!",
                        text: "",
                        icon: "info",
                        closeOnClickOutside: false,
                   }).then(function() {
                              window.location = "login.php";
                          });
            

                    });
                    $(document).on("click", "#btnA", function() {
                        alert(this.id);
                  });
                   
                  </script>
                    ';
        }

    }

    if (isset($_POST['btnLogin'])) {
        $email = runUserInputSanitizationHook($_POST['uname']);
        $password = md5($_POST['password']);

        $sqluserl = "SELECT * FROM `005_omgss_users` WHERE `eMail`='$email' and `pass`='$password'";

        $resultuserl = mysqli_query($conn, $sqluserl);
        if (mysqli_num_rows($resultuserl) > 0) {
            // output data of each row
            $rowuserl = mysqli_fetch_assoc($resultuserl);

            $_SESSION["sessid"] = $rowuserl['id'];
            $_SESSION["eMail"] = $rowuserl['eMail'];
            $_SESSION["name"] = $rowuserl['Name'];

            /*header("Location: index.php");*/
            echo '<script>window.location.href="' . $_SESSION["redirecturi"] . '";</script>';
        } else {
            echo '
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
          <script>
            $( document ).ready(function() {
               swal({
            title: "Oops! Incorrect Credentials!",
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
        mysqli_close($conn);
    }

    if (isset($_POST['respass'])) {
        $recoverData = runUserInputSanitizationHook($_POST['recoverData']);

        $sqluserlr = "SELECT * FROM `005_omgss_users` WHERE `eMail`='$recoverData'";

        $resultuserlr = mysqli_query($conn, $sqluserlr);
        if (mysqli_num_rows($resultuserlr) > 0) {
            // output data of each row
            $rowuserlr = mysqli_fetch_assoc($resultuserlr);
            $randotp = rand(1000, 9999);
            $_SESSION['randotp'] = $randotp;
            $_SESSION['recoverData'] = $recoverData;
            $message = "Your OTP is : " . $randotp;
            $subject = "OTP For Password Reset";
            $to = $recoverData;
            $alertmessage1 = "Otp sent to your email";
            $alertmessage2 = "Please check your email";
            $resultpdf = sendemail($companyEmail, $to, $subject, $message, $alertmessage1, $alertmessage2, "Yes");
            header("Location: resetpassword.php");


        } else {
            echo '
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
          <script>
            $( document ).ready(function() {
               swal({
            title: "Oops! Incorrect Email!",
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
        mysqli_close($conn);
    }


    if (isset($_POST['changepass'])) {
        $otp = runUserInputSanitizationHook($_POST['otp']);
        $npass = md5($_POST['npass']);
        $cpass = md5($_POST['cpass']);
        $randotp = $_SESSION['randotp'];
        $recoverData = $_SESSION['recoverData'];


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


            if ($otp != $randotp) {
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                
                          <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                        <script>
                        $( document ).ready(function() {
                          var span = document.createElement("span");
                            
                         swal({
                            title: "Wrong OTP!",
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
                $sqldel = "UPDATE `005_omgss_users` SET `pass`='$npass' WHERE `eMail`='$recoverData'";
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
                            window.location = "login.php";
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

    function sendemail($to, $companyEmail2, $subject, $message, $alertmessage1, $alertmessage2, $showalert)
    {

        $txt = $message;

        $headers = 'From: ' . $companyEmail2 . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $result = mail($to, $subject, $txt, $headers);


        if ($showalert == "Yes") {
            if (!$result) {
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                <script>
                  $( document ).ready(function() {
                  var span = document.createElement("span");
                  
                 swal({
                    title: "Message could not be sent!",
                    text: "' . $mail->ErrorInfo . '",
                    icon: "error",
                    closeOnClickOutside: false,
             })
              });
              $(document).on("click", "#btnA", function() {
                 alert(this.id);
            });
           </script>';
                exit;
            } else {
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                <script>
                  $( document ).ready(function() {
                  var span = document.createElement("span");            
                 swal({
                    title: "' . $alertmessage1 . '",
                    text: "' . $alertmessage2 . '",
                    icon: "success",
                    closeOnClickOutside: false,
             })
              });
              $(document).on("click", "#btnA", function() {
                 alert(this.id);
            });
           </script>';
            }
        }


    }


    $typecat = runUserInputSanitizationHook($_GET['typecat']);
    if ($typecat == "edit") {
        $sqlcatedit = "SELECT * FROM `005_omgss_categories` WHERE `id`='$catid'";
        $rescatedit = mysqli_query($conn, $sqlcatedit);
        $rowcatedit = mysqli_fetch_assoc($rescatedit);
    }


    if (isset($_POST['addcatedit'])) {
        $categoryname = runUserInputSanitizationHook($_POST['categoryname']);
        $catidedit = runUserInputSanitizationHook($_POST['catidedit']);


        mysqli_query($conn, "UPDATE `005_omgss_categories` SET `name`='$categoryname'  WHERE `id`='$catidedit'");
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Category Updated Successfully !!!",
                        text: "",
                        icon: "success",
                        closeOnClickOutside: false,
                   }).then(function() {
                            window.location = "categories.php";
                        });
            

                    });
                    $(document).on("click", "#btnA", function() {
                        alert(this.id);
                  });
                   
                  </script>
                    ';


    }


    $typesubcat = runUserInputSanitizationHook($_GET['typesubcat']);
    if ($typesubcat == "edit") {
        $sqlsubcatedit = "SELECT * FROM `005_omgss_subcategories` WHERE `id`='$typesubcat'";
        $ressubcatedit = mysqli_query($conn, $sqlsubcatedit);
        $rowsubcatedit = mysqli_fetch_assoc($ressubcatedit);
    }

    $subcatid = runUserInputSanitizationHook($_GET['subcatid']);
    if ($subcatid) {
        $sqlsubcatsedit = "SELECT * FROM `005_omgss_subcategories` WHERE `id`='$subcatid'";
        $ressubcatsedit = mysqli_query($conn, $sqlsubcatsedit);
        $rowsubcatsedit = mysqli_fetch_assoc($ressubcatsedit);
    }


    if (isset($_POST['addsubcatedit'])) {
        $goterror = 0;
        $subcategoryname = runUserInputSanitizationHook($_POST['subcategoryname']);
        $image = md5(date("Y-m-d") . date("h:i:sa") . $_FILES["categoryimg"]["name"]);
        $extensionimage = end(explode(".", $_FILES["categoryimg"]["name"]));
        $finalimagename = $image . "." . $extensionimage;
        $filepathimage = "files/sub/" . $image . "." . $extensionimage;
        /*$categoryimg = runUserInputSanitizationHook($_POST['categoryimg']);*/
        if ($_FILES["categoryimg"]["name"] != "") {
            if (move_uploaded_file($_FILES["categoryimg"]["tmp_name"], $filepathimage)) {

            } else {
                $goterror = 1;
                echo '
		          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		            <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
		            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		          <script>
		            $( document ).ready(function() {
		               swal({
		            title: "Error Uploading Image!",
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
            $catid = runUserInputSanitizationHook($_POST['catid']);
            $subcatidforedit = runUserInputSanitizationHook($_POST['subcatidforedit']);

            if ($goterror == 0) {
                $sqllog = "SELECT * FROM `005_omgss_subcategories` WHERE `subcatnamev`='$subcategoryname'";
                $reslog = mysqli_query($conn, $sqllog);

                if (mysqli_num_rows($reslog) > 1) {

                    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		            
		                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

		                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


		                    <script>
		                    $( document ).ready(function() {
		                      var span = document.createElement("span");
		                        
		                     swal({
		                        title: "Sub Category Already Exists !!!",
		                        text: "",
		                        icon: "info",
		                        closeOnClickOutside: false,
		                   })
		            

		                    });
		                    $(document).on("click", "#btnA", function() {
		                        alert(this.id);
		                  });
		                   
		                  </script>
		                    ';


                } else {

                    mysqli_query($conn, "UPDATE `005_omgss_subcategories` SET `subcatname`='$subcategoryname',`subcatimage`='$finalimagename' WHERE `id`='$subcatidforedit'");
                    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		            
		                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

		                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


		                    <script>
		                    $( document ).ready(function() {
		                      var span = document.createElement("span");
		                        
		                     swal({
		                        title: "Sub Category Updated Successfully !!!",
		                        text: "",
		                        icon: "success",
		                        closeOnClickOutside: false,
		                   }).then(function() {
		                            window.location = "subcategories.php?catid=' . $catid . '";
		                        });
		            

		                    });
		                    $(document).on("click", "#btnA", function() {
		                        alert(this.id);
		                  });
		                   
		                  </script>
		                    ';

                }
            }
        } else {

            $catid = runUserInputSanitizationHook($_POST['catid']);
            $subcatidforedit = runUserInputSanitizationHook($_POST['subcatidforedit']);

            $sqllog = "SELECT * FROM `005_omgss_subcategories` WHERE `subcatnamev`='$subcategoryname'";
            $reslog = mysqli_query($conn, $sqllog);

            if (mysqli_num_rows($reslog) > 1) {

                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		            
		                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

		                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


		                    <script>
		                    $( document ).ready(function() {
		                      var span = document.createElement("span");
		                        
		                     swal({
		                        title: "Sub Category Already Exists !!!",
		                        text: "",
		                        icon: "info",
		                        closeOnClickOutside: false,
		                   })
		            

		                    });
		                    $(document).on("click", "#btnA", function() {
		                        alert(this.id);
		                  });
		                   
		                  </script>
		                    ';


            } else {

                mysqli_query($conn, "UPDATE `005_omgss_subcategories` SET `subcatname`='$subcategoryname' WHERE `id`='$subcatidforedit'");
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		            
		                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

		                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


		                    <script>
		                    $( document ).ready(function() {
		                      var span = document.createElement("span");
		                        
		                     swal({
		                        title: "Sub Category Updated Successfully !!!",
		                        text: "",
		                        icon: "success",
		                        closeOnClickOutside: false,
		                   }).then(function() {
		                            window.location = "subcategories.php?catid=' . $catid . '";
		                        });
		            

		                    });
		                    $(document).on("click", "#btnA", function() {
		                        alert(this.id);
		                  });
		                   
		                  </script>
		                    ';

            }

        }


    }


    $typeprod = runUserInputSanitizationHook($_GET['typeprod']);
    $prid = runUserInputSanitizationHook($_GET['prid']);

    if ($typeprod) {
        $sqlprodsedit = "SELECT * FROM `005_omgss_products` WHERE `id`='$prid'";
        $resprodsedit = mysqli_query($conn, $sqlprodsedit);
        $rowprodsedit = mysqli_fetch_assoc($resprodsedit);
    }


    if (isset($_POST['addprodedit'])) {
        $goterror = 0;
        $productname = runUserInputSanitizationHook($_POST['productname']);
        $tags = runUserInputSanitizationHook($_POST['tags']);
        $maintenancetype = runUserInputSanitizationHook($_POST['maintenancetype']);
        $category = runUserInputSanitizationHook($_POST['category']);
        $units = runUserInputSanitizationHook($_POST['units']);
        $subcategory = runUserInputSanitizationHook($_POST['subcategory']);
        $image = md5(date("Y-m-d") . date("h:i:sa") . $_FILES["productimage"]["name"]);
        $extensionimage = end(explode(".", $_FILES["productimage"]["name"]));
        $finalimagename = $image . "." . $extensionimage;
        $filepathimage = "files/prod/" . $image . "." . $extensionimage;
        /*$categoryimg = runUserInputSanitizationHook($_POST['categoryimg']);*/
        if ($_FILES["productimage"]["name"] != "") {
            if (move_uploaded_file($_FILES["productimage"]["tmp_name"], $filepathimage)) {

            } else {
                $goterror = 1;
                echo '
		            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		              <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		              <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
		              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		            <script>
		              $( document ).ready(function() {
		                 swal({
		              title: "Error Uploading Image!",
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
            $thumbname = "thmb" . $finalimagename;
            if (createThumb($filepathimage, "./files/thumbnails/" . $thumbname, $extensionimage, 300, 200)) {


            } else {
                $goterror = 1;
                echo '
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                  <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                <script>
                  $( document ).ready(function() {
                     swal({
                  title: "Error Uploading Thumbnail!",
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
            $saleprice = runUserInputSanitizationHook($_POST['saleprice']);
            $actualprice = runUserInputSanitizationHook($_POST['actualprice']);
            $description = runUserInputSanitizationHook($_POST['description']);
            $pridforedit = runUserInputSanitizationHook($_POST['pridforedit']);

            if ($goterror == 0) {

                mysqli_query($conn, "UPDATE `005_omgss_products` SET `name`='$productname',`categoryid`='$category',`subcategoryid`='$subcategory',`image`='$finalimagename',`units`='$units',`saleprice`='$saleprice',`actualprice`='$actualprice',`description`='$description', `maintenancetype`='$maintenancetype',`tags`='$tags',`thumbnail`='$thumbname' WHERE `id`='$pridforedit'");
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		              
		                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

		                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


		                      <script>
		                      $( document ).ready(function() {
		                        var span = document.createElement("span");
		                          
		                       swal({
		                          title: "Product Updated Successfully !!!",
		                          text: "",
		                          icon: "success",
		                          closeOnClickOutside: false,
		                     }).then(function() {
		                              window.location = "products.php";
		                          });
		              

		                      });
		                      $(document).on("click", "#btnA", function() {
		                          alert(this.id);
		                    });
		                     
		                    </script>
		                      ';


            }
        } else {

            $saleprice = runUserInputSanitizationHook($_POST['saleprice']);
            $actualprice = runUserInputSanitizationHook($_POST['actualprice']);
            $description = runUserInputSanitizationHook($_POST['description']);
            $pridforedit = runUserInputSanitizationHook($_POST['pridforedit']);

            if ($goterror == 0) {

                mysqli_query($conn, "UPDATE `005_omgss_products` SET `name`='$productname',`categoryid`='$category',`subcategoryid`='$subcategory',`units`='$units',`saleprice`='$saleprice',`actualprice`='$actualprice',`description`='$description', `maintenancetype`='$maintenancetype',`tags`='$tags' WHERE `id`='$pridforedit'");
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		              
		                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

		                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


		                      <script>
		                      $( document ).ready(function() {
		                        var span = document.createElement("span");
		                          
		                       swal({
		                          title: "Product Updated Successfully !!!",
		                          text: "",
		                          icon: "success",
		                          closeOnClickOutside: false,
		                     }).then(function() {
		                              window.location = "products.php";
		                          });
		              

		                      });
		                      $(document).on("click", "#btnA", function() {
		                          alert(this.id);
		                    });
		                     
		                    </script>
		                      ';


            }
        }


    }


    if (isset($_POST['addhomeslider'])) {

        $image = md5(date("Y-m-d") . date("h:i:sa") . $_FILES["sliderimage"]["name"]);
        $extensionimage = end(explode(".", $_FILES["sliderimage"]["name"]));
        $finalimagename = $image . "." . $extensionimage;
        $filepathimage = "files/extras/" . $image . "." . $extensionimage;

        $goterror = 0;
        if (move_uploaded_file($_FILES["sliderimage"]["tmp_name"], $filepathimage)) {

        } else {
            $goterror = 1;
            echo '
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
             <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
             <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
             <script>
                    $( document ).ready(function() {
                       swal({
                    title: "Error Uploading Image!",
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


        if ($goterror == 0) {
            $tagline1 = runUserInputSanitizationHook($_POST['tagline1']);
            $tagline2 = runUserInputSanitizationHook($_POST['tagline2']);

            mysqli_query($conn, "INSERT INTO `005_omgss_homepageslider`(`sliderimage`,`tagline1`,`tagline2`)VALUES('$finalimagename','$tagline1','$tagline2')");
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "Home Page Slider Image Uploaded Successfully !!!",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "homesliderimages.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';
        }

    }

    $sqlhomeslider = "SELECT * FROM `005_omgss_homepageslider`";
    $reshomeslider = mysqli_query($conn, $sqlhomeslider);
    $counthomeslider = mysqli_num_rows($reshomeslider);


    /*if(isset($_POST['searchbtn'])) {
            $searchtext= runUserInputSanitizationHook($_POST['searchtext']);

            $sqlsearch="SELECT * FROM `005_omgss_subcategories` WHERE `subcatname` LIKE '%$searchtext%'";
            $ressearch=mysqli_query($conn,$sqlsearch);
            $countsearch=mysqli_num_rows($ressearch);
    }*/

    $ip = $_SERVER['REMOTE_ADDR'];

    $sqlallprd = "SELECT * FROM `005_omgss_products`";
    $resallprd = mysqli_query($conn, $sqlallprd);


    if ($loggeduserid) {
        $sqlcountallcart = "SELECT * FROM `005_omgss_cart` WHERE `ip`='$ip' OR `userid`='$loggeduserid'";
    } else {
        $sqlcountallcart = "SELECT * FROM `005_omgss_cart` WHERE `ip`='$ip'";
    }
    $rescountallcart = mysqli_query($conn, $sqlcountallcart);
    $countallcart = mysqli_num_rows($rescountallcart);


    if ($loggeduserid) {
        $sqlcountallwish = "SELECT * FROM `005_omgss_wishlist` WHERE `ip`='$ip' OR `userid`='$loggeduserid'";
    } else {
        $sqlcountallwish = "SELECT * FROM `005_omgss_wishlist` WHERE `ip`='$ip'";
    }
    $rescountallwish = mysqli_query($conn, $sqlcountallwish);
    $countallwish = mysqli_num_rows($rescountallwish);


    if (isset($_POST['cartsubmitbtn'])) {
        $totalvalue = runUserInputSanitizationHook($_POST['totalvalue']);
        $_SESSION['totalvalue'] = $totalvalue;
        if ($_SESSION["sessid"] == "") {
            $_SESSION["redirecturi"] = "checkout.php";
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "You must login first !!!",
                          text: "",
                          icon: "info",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "login.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';
        } else {
            echo '<script>window.location.href="checkout.php";</script>';
        }


    }

    $linkpage = $_SERVER['REQUEST_URI'];


    if (isset($_POST['postcomment'])) {
        $rating = runUserInputSanitizationHook($_POST['rating']);
        $messagerev = runUserInputSanitizationHook($_POST['messagerev']);
        $prdidrv = runUserInputSanitizationHook($_POST['prdidrv']);
        if ($_SESSION["sessid"] == "") {
            $_SESSION["redirecturi"] = $linkpage;
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "You must login first !!!",
                          text: "",
                          icon: "info",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "login.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';
        } else {

            mysqli_query($conn, "INSERT INTO `005_omgss_reviews`(`productid`,`userid`,`review`,`rating`) VALUES ('$prdidrv','$loggeduserid','$messagerev','$rating')");
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "Review Submitted Successfully",
                          text: "",
                          icon: "success",
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

    $sqlrevws = "SELECT * FROM `005_omgss_reviews` WHERE `userid`='$loggeduserid' AND `productid`='$prodid'";
    $resrevws = mysqli_query($conn, $sqlrevws);
    $countrevws = mysqli_num_rows($resrevws);

    $sqlrevwsall = "SELECT * FROM `005_omgss_reviews` WHERE `productid`='$prodid'";
    $resrevwsall = mysqli_query($conn, $sqlrevwsall);
    $countrevwsall = mysqli_num_rows($resrevwsall);


    if (isset($_POST['addcop'])) {
        $couponname = runUserInputSanitizationHook($_POST['couponname']);
        $couponcode = runUserInputSanitizationHook($_POST['couponcode']);
        $coupontype = runUserInputSanitizationHook($_POST['coupontype']);
        $couponamount = runUserInputSanitizationHook($_POST['couponamount']);
        $usageperuser = runUserInputSanitizationHook($_POST['usageperuser']);


        mysqli_query($conn, "INSERT INTO `005_omgss_coupons`(`couponname`,`couponcode`,`coupontype`,`couponamount`,`usageperuser`) VALUES ('$couponname','$couponcode','$coupontype','$couponamount','$usageperuser')");
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "Coupon Added Successfully",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "coupons.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';


    }


    $sqlcoupons = "SELECT * FROM `005_omgss_coupons` ORDER BY `id` DESC";
    $rescoupons = mysqli_query($conn, $sqlcoupons);
    $countcoupons = mysqli_num_rows($rescoupons);

    $coup = runUserInputSanitizationHook($_GET['coup']);
    $typecoup = runUserInputSanitizationHook($_GET['typecoup']);

    $sqlcoupview = "SELECT * FROM `005_omgss_coupons` WHERE `id`='$coup'";
    $rescoupview = mysqli_query($conn, $sqlcoupview);
    $rowcoupview = mysqli_fetch_assoc($rescoupview);


    if (isset($_POST['addcopedit'])) {
        $couponname = runUserInputSanitizationHook($_POST['couponname']);
        $couponcode = runUserInputSanitizationHook($_POST['couponcode']);
        $coupontype = runUserInputSanitizationHook($_POST['coupontype']);
        $couponamount = runUserInputSanitizationHook($_POST['couponamount']);
        $usageperuser = runUserInputSanitizationHook($_POST['usageperuser']);
        $coupidedit = runUserInputSanitizationHook($_POST['coupidedit']);


        mysqli_query($conn, "UPDATE `005_omgss_coupons` SET `couponname`='$couponname',`couponcode`='$couponcode',`coupontype`='$coupontype',`couponamount`='$couponamount',`usageperuser`='$usageperuser' WHERE `id`='$coupidedit'");
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "Coupon Updated Successfully",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "coupons.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';


    }

    if (isset($_POST['couponapply'])) {
        if ($_SESSION["sessid"] == "") {
            $_SESSION["redirecturi"] = "cart.php";
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "You must login first !!!",
                          text: "",
                          icon: "info",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "login.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';
        } else {
            $totalvalue = runUserInputSanitizationHook($_POST['totalvalue']);
            $couponcodefr = runUserInputSanitizationHook($_POST['couponcodefr']);

            $sqlchkcoup = "SELECT * FROM `005_omgss_coupons` WHERE `couponcode`='$couponcodefr'";
            $reschkcoup = mysqli_query($conn, $sqlchkcoup);
            if (mysqli_num_rows($reschkcoup) > 0) {
                $rowchkcoup = mysqli_fetch_assoc($reschkcoup);

                $couponid = $rowchkcoup['id'];
                $couponname = $rowchkcoup['couponname'];
                $couponcode = $rowchkcoup['couponcode'];
                $coupontype = $rowchkcoup['coupontype'];
                $couponamount = $rowchkcoup['couponamount'];
                $usageperuser = $rowchkcoup['usageperuser'];


                $sqlchkusercoup = "SELECT * FROM `005_omgss_orders` WHERE `userid`='$loggeduserid' AND `couponcode`='$couponid'";
                $reschkusercoup = mysqli_query($conn, $sqlchkusercoup);
                $countusersappliedcoup = mysqli_num_rows($reschkusercoup);

                if ($countusersappliedcoup < $usageperuser) {
                    if ($coupontype == 1) {
                        $afterdisc = $totalvalue - (($couponamount / 100) * $totalvalue);
                        $_SESSION['coupdisc'] = ($couponamount / 100) * $totalvalue;
                        $_SESSION['coupidfrsv'] = $couponid;

                        $_SESSION['disccouptypesh'] = $couponamount . "%";

                    } else if ($coupontype == 2) {
                        $afterdisc = $totalvalue - $couponamount;
                        $_SESSION['coupdisc'] = $couponamount;
                        $_SESSION['coupidfrsv'] = $couponid;

                        $_SESSION['disccouptypesh'] = "Rs. " . $couponamount;
                    }
                } else {
                    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                  
                            <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                          <script>
                          $( document ).ready(function() {
                            var span = document.createElement("span");
                              
                           swal({
                              title: "",
                              text: "You have utilized the maximum redemtion of this coupon, please select another coupon !!!",
                              
                              closeOnClickOutside: false,
                         })
                  

                          });
                          $(document).on("click", "#btnA", function() {
                              alert(this.id);
                        });
                         
                        </script>
                          ';
                }
            } else {
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                  
                            <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                          <script>
                          $( document ).ready(function() {
                            var span = document.createElement("span");
                              
                           swal({
                              title: "Invalid Coupon !!!",
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

    $sqlordersad = "SELECT * FROM `005_omgss_orders` WHERE `status`='Success' ORDER BY `id` DESC";
    $resordersad = mysqli_query($conn, $sqlordersad);
    $countordersad = mysqli_num_rows($resordersad);


    if (isset($_POST['btnsupport'])) {
        $name = runUserInputSanitizationHook($_REQUEST['name']);
        $contactno = runUserInputSanitizationHook($_REQUEST['contactno']);
        $email = runUserInputSanitizationHook($_REQUEST['email']);

        $message = runUserInputSanitizationHook($_REQUEST['message']);

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

                              <span style="font-size: 18px; font-weight: normal;">Support Query Received From OMGSS Website.</span>

                          </td>

                      </tr>

                      <!-- Messages -->

                      <tr>

                          <td align="left" valign="top" colspan="2" style="padding-top: 10px;">

                              <span style="font-size: 12px; line-height: 1; color: #333333;">

                                  Name : <b>' . $name . '</b>

                                  <br /><br />

                                  Phone : <b>' . $contactno . '</b>

                                  <br /><br />

                                  Email : <b>' . $email . '</b>

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
        $subject = "Support Query Received From OMGSS Website";
        $alertmessage1 = "Message Sent";
        $alertmessage2 = "";
        $resultpdf = sendemail($companyEmail, "noreply@omgss.in", $subject, $EmailBody, $alertmessage1, $alertmessage2, "Yes");


    }


    if (isset($_POST['updatecompanydetails'])) {
        $companyemailsvad = runUserInputSanitizationHook($_POST['companyemailsvad']);


        $sqllog = "UPDATE `005_omgss_companydetails` SET `companyemail`='$companyemailsvad' WHERE `id`=1";
        $reslog = mysqli_query($conn, $sqllog);


        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Company Details Updated Successfully !!!",
                        text: "",
                        icon: "success",
                        closeOnClickOutside: false,
                   })
            

                    });
                    $(document).on("click", "#btnA", function() {
                        alert(this.id);
                  });
                   
                  </script>
                    ';


    }


    if (isset($_POST['profileupdate'])) {
        $Name = runUserInputSanitizationHook($_POST['Name']);
        $Email = runUserInputSanitizationHook($_POST['Email']);
        $Phone = runUserInputSanitizationHook($_POST['Phone']);
        $Address = runUserInputSanitizationHook($_POST['Address']);
        $Location = runUserInputSanitizationHook($_POST['Location']);


        $sqllog = "UPDATE `005_omgss_users` SET `eMail`='$Email',`Name`='$Name',`Phone`='$Phone',`Address`='$Address',`Location`='$Location' WHERE `id`='$loggeduserid'";
        $reslog = mysqli_query($conn, $sqllog);


        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Profile Updated Successfully !!!",
                        text: "",
                        icon: "success",
                        closeOnClickOutside: false,
                   })
            

                    });
                    $(document).on("click", "#btnA", function() {
                        alert(this.id);
                  });
                   
                  </script>
                    ';


    }

    $sqlprofile = "SELECT * FROM `005_omgss_users` WHERE `id`='$loggeduserid'";
    $resprofile = mysqli_query($conn, $sqlprofile);
    $rowprofile = mysqli_fetch_assoc($resprofile);


    if (isset($_POST['addaddress'])) {
        $addressprofilename = runUserInputSanitizationHook($_POST['addressprofilename']);
        $fullname = runUserInputSanitizationHook($_POST['fullname']);
        $Email = runUserInputSanitizationHook($_POST['Email']);
        $Address = runUserInputSanitizationHook($_POST['Address']);
        $City = runUserInputSanitizationHook($_POST['City']);
        $State = runUserInputSanitizationHook($_POST['State']);
        $Zip = runUserInputSanitizationHook($_POST['Zip']);

        $sqllog = "INSERT INTO `005_omgss_billingaddresses` (`userid`, `addressprofilename`, `fullname`, `Email`, `Address`, `City`, `State`, `Zip`) VALUES ('$loggeduserid','$addressprofilename','$fullname','$Email','$Address','$City','$State','$Zip')";
        $reslog = mysqli_query($conn, $sqllog);


        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Address Added Successfully !!!",
                        text: "",
                        icon: "success",
                        closeOnClickOutside: false,
                   }).then(function() {
                              window.location = "myaddresses.php";
                          });
            

                    });
                    $(document).on("click", "#btnA", function() {
                        alert(this.id);
                  });
                   
                  </script>
                    ';


    }

    $sqlbilladd = "SELECT * FROM `005_omgss_billingaddresses` WHERE `userid`='$loggeduserid'";
    $resbilladd = mysqli_query($conn, $sqlbilladd);
    $countbilladd = mysqli_num_rows($resbilladd);


    $badd = runUserInputSanitizationHook($_GET['badd']);
    $typebadd = runUserInputSanitizationHook($_GET['typebadd']);
    if ($badd) {
        $sqlbaddev = "SELECT * FROM `005_omgss_billingaddresses` WHERE `id`='$badd'";
        $resbaddev = mysqli_query($conn, $sqlbaddev);
        $rowbaddev = mysqli_fetch_assoc($resbaddev);
    }


    if (isset($_POST['addaddressedit'])) {
        $addressprofilename = runUserInputSanitizationHook($_POST['addressprofilename']);
        $fullname = runUserInputSanitizationHook($_POST['fullname']);
        $Email = runUserInputSanitizationHook($_POST['Email']);
        $Address = runUserInputSanitizationHook($_POST['Address']);
        $City = runUserInputSanitizationHook($_POST['City']);
        $State = runUserInputSanitizationHook($_POST['State']);
        $Zip = runUserInputSanitizationHook($_POST['Zip']);
        $baddforedit = runUserInputSanitizationHook($_POST['baddforedit']);

        $sqllog = "UPDATE `005_omgss_billingaddresses` SET `addressprofilename`='$addressprofilename',`fullname`='$fullname',`Email`='$Email',`Address`='$Address',`City`='$City',`State`='$State',`Zip`='$Zip' WHERE `id`='$baddforedit'";
        $reslog = mysqli_query($conn, $sqllog);


        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
                      <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                    <script>
                    $( document ).ready(function() {
                      var span = document.createElement("span");
                        
                     swal({
                        title: "Address Updated Successfully !!!",
                        text: "",
                        icon: "success",
                        closeOnClickOutside: false,
                   }).then(function() {
                              window.location = "myaddresses.php";
                          });
            

                    });
                    $(document).on("click", "#btnA", function() {
                        alert(this.id);
                  });
                   
                  </script>
                    ';


    }


    if (isset($_POST['resspassfront'])) {
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

            $sqllog1 = "SELECT * FROM `005_omgss_users` WHERE `id`='$loggeduserid'";
            $reslog1 = mysqli_query($conn, $sqllog1);
            $rowlog1 = mysqli_fetch_assoc($reslog1);
            $odpass = $rowlog1['pass'];
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
                $sqldel = "UPDATE `005_omgss_users` SET `pass`='$npass' WHERE `id`='$loggeduserid'";
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


    if (isset($_POST['buttonbillingadd'])) {
        $_SESSION['billingaddressidforuser'] = runUserInputSanitizationHook($_POST['selid']);

    }
    $billingaddressidforuser = $_SESSION['billingaddressidforuser'];
    $sqlbaddevbillingaddressidforuser = "SELECT * FROM `005_omgss_billingaddresses` WHERE `id`='$billingaddressidforuser'";
    $resbaddevbillingaddressidforuser = mysqli_query($conn, $sqlbaddevbillingaddressidforuser);
    $rowbaddevbillingaddressidforuser = mysqli_fetch_assoc($resbaddevbillingaddressidforuser);


    $sqlordersofuser = "SELECT * FROM `005_omgss_orders` WHERE `userid`='$loggeduserid' ORDER BY `id` DESC";
    $resordersofuser = mysqli_query($conn, $sqlordersofuser);
    $countordersofuser = mysqli_num_rows($resordersofuser);

    $sqlcoupshfr = "SELECT * FROM `005_omgss_coupons` ORDER BY `id` DESC";
    $rescoupshfr = mysqli_query($conn, $sqlcoupshfr);
    $countcoupshfr = mysqli_num_rows($rescoupshfr);


    $sqlgetdevicesfr = "SELECT * FROM `003_omgss_devices` WHERE `userid`='$loggeduserid' ORDER BY `id` DESC";
    $resgetdevicesfr = mysqli_query($conn, $sqlgetdevicesfr);
    $countgetdevicesfr = mysqli_num_rows($resgetdevicesfr);

    $sqlgetdevicesfrcom = "SELECT * FROM `003_omgss_devices` WHERE `userid`='$loggeduserid' ORDER BY `id` DESC";
    $resgetdevicesfrcom = mysqli_query($conn, $sqlgetdevicesfrcom);
    $countgetdevicesfrcom = mysqli_num_rows($resgetdevicesfrcom);


    if (isset($_POST['addnotification'])) {
        $goterror = 0;
        $notificationname = runUserInputSanitizationHook($_POST['notificationname']);
        $image = md5(date("Y-m-d") . date("h:i:sa") . $_FILES["notificationimage"]["name"]);
        $extensionimage = end(explode(".", $_FILES["notificationimage"]["name"]));
        $finalimagename = $image . "." . $extensionimage;
        $filepathimage = "files/noti/" . $image . "." . $extensionimage;


        if (move_uploaded_file($_FILES["notificationimage"]["tmp_name"], $filepathimage)) {

        } else {
            $goterror = 1;
            echo '
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
              <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script>
              $( document ).ready(function() {
                 swal({
              title: "Error Uploading Image!",
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


        if ($goterror == 0) {
            $sqllog = "SELECT * FROM `005_omgss_notifications` WHERE `description`='$notificationname'";
            $reslog = mysqli_query($conn, $sqllog);

            if (mysqli_num_rows($reslog) > 0) {

                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "Notification Already Exists !!!",
                          text: "",
                          icon: "info",
                          closeOnClickOutside: false,
                     })
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';


            } else {

                mysqli_query($conn, "INSERT INTO `005_omgss_notifications`(`image`,`description`) VALUES ('$finalimagename','$notificationname')");
                $notilastid = mysqli_insert_id($conn);
                $sqlgetuserfornoti = "SELECT * FROM `005_omgss_users`";
                $resgetuserfornoti = mysqli_query($conn, $sqlgetuserfornoti);
                while ($rowgetuserfornoti = mysqli_fetch_assoc($resgetuserfornoti)) {
                    $usridnoti = $rowgetuserfornoti['id'];
                    mysqli_query($conn, "INSERT INTO `005_omgss_usernotifications`(`userid`,`notificationid`)VALUES('$usridnoti','$notilastid')");
                }

                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              
                        <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                      <script>
                      $( document ).ready(function() {
                        var span = document.createElement("span");
                          
                       swal({
                          title: "Notification Added Successfully !!!",
                          text: "",
                          icon: "success",
                          closeOnClickOutside: false,
                     }).then(function() {
                              window.location = "notifications.php";
                          });
              

                      });
                      $(document).on("click", "#btnA", function() {
                          alert(this.id);
                    });
                     
                    </script>
                      ';

            }
        }


    }

    $sqlnoti = "SELECT * FROM `005_omgss_notifications` ORDER BY `id` DESC";
    $resnoti = mysqli_query($conn, $sqlnoti);
    $countnoti = mysqli_num_rows($resnoti);

    $sqlnoti23 = "SELECT * FROM `005_omgss_notifications` ORDER BY `id` DESC LIMIT 20";
    $resnoti23 = mysqli_query($conn, $sqlnoti23);
    $countnoti23 = mysqli_num_rows($resnoti23);

    $sqlnotiuserfr = "SELECT * FROM `005_omgss_usernotifications` WHERE `userid`='$loggeduserid' ORDER BY `id` DESC LIMIT 20";
    $resnotiuserfr = mysqli_query($conn, $sqlnotiuserfr);
    $countnotiuserfr = mysqli_num_rows($resnotiuserfr);


    $notiid = runUserInputSanitizationHook($_GET['notiid']);
    if ($notiid) {
        $sqlnotiname = "SELECT * FROM `005_omgss_notifications` WHERE `id`='$notiid'";
        $resnotiname = mysqli_query($conn, $sqlnotiname);
        $rownotiname = mysqli_fetch_assoc($resnotiname);

        /*$sqlsubcats="SELECT * FROM `005_omgss_subcategories` WHERE `catid`='$catid'";
        $ressubcats=mysqli_query($conn,$sqlsubcats);
        $countsubcats=mysqli_num_rows($ressubcats);*/
    }

    $typenoti = runUserInputSanitizationHook($_GET['typenoti']);


    if (isset($_POST['addnotificationedit'])) {
        $goterror = 0;
        $notificationname = runUserInputSanitizationHook($_POST['notificationname']);
        $image = md5(date("Y-m-d") . date("h:i:sa") . $_FILES["notificationimage"]["name"]);
        $extensionimage = end(explode(".", $_FILES["notificationimage"]["name"]));
        $finalimagename = $image . "." . $extensionimage;
        $filepathimage = "files/noti/" . $image . "." . $extensionimage;

        if ($_FILES["notificationimage"]["name"] != "") {
            if (move_uploaded_file($_FILES["notificationimage"]["tmp_name"], $filepathimage)) {

            } else {
                $goterror = 1;
                echo '
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
              <script>
                $( document ).ready(function() {
                   swal({
                title: "Error Uploading Image!",
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

            $notiidforedit = runUserInputSanitizationHook($_POST['notiidforedit']);

            if ($goterror == 0) {
                $sqllog = "SELECT * FROM `005_omgss_notifications` WHERE `description`='$notificationname'";
                $reslog = mysqli_query($conn, $sqllog);

                if (mysqli_num_rows($reslog) > 1) {

                    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                
                          <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                        <script>
                        $( document ).ready(function() {
                          var span = document.createElement("span");
                            
                         swal({
                            title: "Notification Already Exists !!!",
                            text: "",
                            icon: "info",
                            closeOnClickOutside: false,
                       })
                

                        });
                        $(document).on("click", "#btnA", function() {
                            alert(this.id);
                      });
                       
                      </script>
                        ';


                } else {

                    mysqli_query($conn, "UPDATE `005_omgss_notifications` SET `image`='$finalimagename',`description`='$notificationname' WHERE `id`='$notiidforedit'");
                    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                
                          <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                        <script>
                        $( document ).ready(function() {
                          var span = document.createElement("span");
                            
                         swal({
                            title: "Notification Updated Successfully !!!",
                            text: "",
                            icon: "success",
                            closeOnClickOutside: false,
                       }).then(function() {
                                window.location = "notifications.php";
                            });
                

                        });
                        $(document).on("click", "#btnA", function() {
                            alert(this.id);
                      });
                       
                      </script>
                        ';

                }
            }
        } else {

            $notiidforedit = runUserInputSanitizationHook($_POST['notiidforedit']);

            $sqllog = "SELECT * FROM `005_omgss_notifications` WHERE `description`='$notificationname'";
            $reslog = mysqli_query($conn, $sqllog);

            if (mysqli_num_rows($reslog) > 1) {

                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                
                          <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                        <script>
                        $( document ).ready(function() {
                          var span = document.createElement("span");
                            
                         swal({
                            title: "Notification Already Exists !!!",
                            text: "",
                            icon: "info",
                            closeOnClickOutside: false,
                       })
                

                        });
                        $(document).on("click", "#btnA", function() {
                            alert(this.id);
                      });
                       
                      </script>
                        ';


            } else {

                mysqli_query($conn, "UPDATE `005_omgss_notifications` SET `description`='$notificationname' WHERE `id`='$notiidforedit'");
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                
                          <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                        <script>
                        $( document ).ready(function() {
                          var span = document.createElement("span");
                            
                         swal({
                            title: "Notification Updated Successfully !!!",
                            text: "",
                            icon: "success",
                            closeOnClickOutside: false,
                       }).then(function() {
                                window.location = "notifications.php";
                            });
                

                        });
                        $(document).on("click", "#btnA", function() {
                            alert(this.id);
                      });
                       
                      </script>
                        ';

            }

        }


    }


    if (isset($_POST['submitbtncomplain'])) {
        if ($loggeduserid) {


            $dev = runUserInputSanitizationHook($_POST['dev']);
            $complaint = runUserInputSanitizationHook($_POST['complaint']);

            $sqlgetemailofuser = "SELECT * FROM `005_omgss_users` WHERE `id`='$loggeduserid'";
            $resgetemailofuser = mysqli_query($conn, $sqlgetemailofuser);
            $rowgetemailofuser = mysqli_fetch_assoc($resgetemailofuser);

            $sqlgetdevdet = "SELECT * FROM `003_omgss_devices` WHERE `id`='$dev'";
            $resgetdevdet = mysqli_query($conn, $sqlgetdevdet);
            $rowgetdevdet = mysqli_fetch_assoc($resgetdevdet);

            $gtprdidcomsub = $rowgetdevdet['productid'];
            $sqlprpcomsub = "SELECT * FROM `005_omgss_products` WHERE `id`='$gtprdidcomsub'";
            $resprpcomsub = mysqli_query($conn, $sqlprpcomsub);
            $rowprpcomsub = mysqli_fetch_assoc($resprpcomsub);


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

                              <span style="font-size: 18px; font-weight: normal;">Complaint Received From User Regarding Devices Maintainance..</span>

                          </td>

                      </tr>

                      <!-- Messages -->

                      <tr>

                          <td align="left" valign="top" colspan="2" style="padding-top: 10px;">

                              <span style="font-size: 12px; line-height: 1; color: #333333;">

                                  User Email : <b>' . $rowgetemailofuser['eMail'] . '</b>

                                  <br /><br />

                                  Device Name : <b>' . $rowprpcomsub['name'] . '</b>

                                  <br /><br />

                                  Complaint : <b>' . $complaint . '</b>

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
            $subject = "Complaint Received From User Regarding Devices Maintainance From OMGSS Website.";
            $alertmessage1 = "";
            $alertmessage2 = "";
            $resultpdf = sendemail($companyEmail, "noreply@omgss.in", $subject, $EmailBody, $alertmessage1, $alertmessage2, "No");

            mysqli_query($conn, "INSERT INTO `005_omgss_complaints`(`userid`,`deviceid`,`complaint`)VALUES('$loggeduserid','$dev','$complaint')");
            $complaintlastid = mysqli_insert_id($conn);
            $messnoti = "We have received you complaint OMGCOMP" . $complaintlastid . ". We will revert Shortly.";
            mysqli_query($conn, "INSERT INTO `005_omgss_usernotifications`(`userid`,`image`,`content`)VALUES('$loggeduserid','pass.png','$messnoti')");
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                
                          <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                        <script>
                        $( document ).ready(function() {
                          var span = document.createElement("span");
                            
                         swal({
                            title: "Complaint Submitted Successfully",
                            text: "We will Revert shortly",
                            icon: "success",
                            closeOnClickOutside: false,
                       }).then(function() {
                                window.location = "mydevices.php";
                            });
                

                        });
                        $(document).on("click", "#btnA", function() {
                            alert(this.id);
                      });
                       
                      </script>
                        ';

        }
    }


    $sqlshowalldevicesinadmin = "SELECT * FROM `003_omgss_devices` ORDER BY `id` DESC";
    $resshowalldevicesinadmin = mysqli_query($conn, $sqlshowalldevicesinadmin);
    $countshowalldevicesinadmin = mysqli_num_rows($resshowalldevicesinadmin);


    if (isset($_POST['combtnchange'])) {
        $statuscom = runUserInputSanitizationHook($_POST['statuscom']);
        $comid = runUserInputSanitizationHook($_POST['comid']);


        mysqli_query($conn, "UPDATE `005_omgss_complaints` SET `status`='$statuscom' WHERE `id`='$comid'");
        if ($statuscom == "Solved") {
            $messnoti = "Your Compaint OMGCOMP " . $comid . " has been marked Solved.";
            mysqli_query($conn, "INSERT INTO `005_omgss_usernotifications`(`userid`,`image`,`content`)VALUES('$loggeduserid','pass.png','$messnoti')");
        }

    }


    $sqlshowallcomplaintsinadmin = "SELECT * FROM `005_omgss_complaints` ORDER BY `id` DESC";
    $resshowallcomplaintsinadmin = mysqli_query($conn, $sqlshowallcomplaintsinadmin);
    $countshowallcomplaintsinadmin = mysqli_num_rows($resshowallcomplaintsinadmin);


    $sqlgetprocessingorders = "SELECT * FROM `005_omgss_orders` WHERE `userid`='$loggeduserid' AND `orderstate`='Processing'";
    $resgetprocessingorders = mysqli_query($conn, $sqlgetprocessingorders);
    $countgetprocessingorders = mysqli_num_rows($resgetprocessingorders);

    $sqldevmyaccount = "SELECT * FROM `003_omgss_devices` WHERE `userid`='$loggeduserid'";
    $resdevmyaccount = mysqli_query($conn, $sqldevmyaccount);
    $countNotexpire = 0;
    while ($rowdevmyaccount = mysqli_fetch_assoc($resdevmyaccount)) {
        $date12 = date("Y/m/d");
        $date22 = date('Y-m-d H:i:s', strtotime($rowdevmyaccount['datetime'] . ' + 365 days'));
        $diff2 = strtotime($date22) - strtotime($date12);
        $dateDiff2 = abs(round($diff2 / 86400));
        if ($diff2 > 0) {
            $countNotexpire++;
        }
    }


    $sqlcomphis = "SELECT * FROM `005_omgss_complaints` WHERE `userid`='$loggeduserid' ORDER BY `id` DESC";
    $rescomphis = mysqli_query($conn, $sqlcomphis);
    $countcomphis = mysqli_num_rows($rescomphis);


    $sqlcountnot = "SELECT * FROM `005_omgss_complaints` WHERE `countnotify`='No'";
    $rescountnot = mysqli_query($conn, $sqlcountnot);
    $getcountcountnot = mysqli_num_rows($rescountnot);

?>