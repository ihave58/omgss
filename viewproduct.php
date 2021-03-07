<?php
    include('header.php');
?>
<?php
    $crtchkproductid = $rowviewprod['id'];
    if ($_SESSION["sessid"] == "") {

        $sqlcrtchk = "SELECT * FROM `005_omgss_cart` WHERE `prdid`='$crtchkproductid' AND `ip`='$ip'";
    } else {
        $useridcartchk = $_SESSION["sessid"];
        $sqlcrtchk = "SELECT * FROM `005_omgss_cart` WHERE `prdid`='$crtchkproductid' AND (`userid`='$useridcartchk' OR `ip`='$ip')";
    }
    $rescrtchk = mysqli_query($conn, $sqlcrtchk);
    $countcrtchk = mysqli_num_rows($rescrtchk);
    $rowcrtchk = mysqli_fetch_assoc($rescrtchk);
    $qntycartchk = $rowcrtchk['quantity'];
    $idcartchk = $rowcrtchk['id'];

    if ($_SESSION["sessid"] == "") {

        $sqlwishchk = "SELECT * FROM `005_omgss_wishlist` WHERE `prdid`='$crtchkproductid' AND `ip`='$ip'";
    } else {
        $useridwishchk = $_SESSION["sessid"];
        $sqlwishchk = "SELECT * FROM `005_omgss_wishlist` WHERE `prdid`='$crtchkproductid' AND (`userid`='$useridwishchk' OR `ip`='$ip')";
    }
    $reswishchk = mysqli_query($conn, $sqlwishchk);
    $countwishchk = mysqli_num_rows($reswishchk);

?>
    <style>


        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }


        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }


        .tab button:hover {
            background-color: #ddd;
        }


        .tab button.active {
            background-color: #ccc;
        }


        .tabcontent {
            display: none;
            padding: 6px 12px;
            /* border: 1px solid #ccc;*/
            border-top: none;
        }

        button.tablinks {
            width: 50%;
        }

        .plusminus {
            background: lightgrey;
            padding: 5px;
        }

        .btn-primary {
            color: #fff !important;
            background-color: #007bff !important;
            border-color: #007bff !important;
        }
    </style>


    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <p>
                        <img src="admin/files/prod/<?php echo $rowviewprod['image']; ?>" alt=""
                             style=" height:367px; /* width:730px; " class="img-fluid">
                    </p>

                    <h2 class="mb-3 mt-5"><?php echo $rowviewprod['name']; ?></h2>


                    <div class="tab">
                        <button class="tablinks" id="london" onclick="openCity(event, 'London')">Description</button>
                        <button class="tablinks" onclick="openCity(event, 'Paris')">Reviews</button>
                        <!-- <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button> -->
                    </div>

                    <div id="London" class="tabcontent">
                        <?php echo $rowviewprod['description']; ?>
                    </div>

                    <div id="Paris" class="tabcontent">
                        <div class="pt-5 mt-5">
                            <h3 class="mb-5"><?php echo $countrevwsall; ?> Comments</h3>
                            <ul class="comment-list">

                                <?php
                                    while ($rowrevwsall = mysqli_fetch_assoc($resrevwsall)) {
                                        $useridofthis = $rowrevwsall['userid'];
                                        $sqlofthisname = "SELECT * FROM `005_omgss_users` WHERE `id`='$useridofthis'";
                                        $resofthisname = mysqli_query($conn, $sqlofthisname);
                                        $rowofthisname = mysqli_fetch_assoc($resofthisname);
                                        ?>
                                        <li class="comment">
                                            <div class="vcard bio">
                                                <!--  <img src="images/person_1.jpg" alt="Image placeholder"> -->
                                            </div>
                                            <div class="comment-body">
                                                <h3><?php echo $rowofthisname['Name']; ?></h3>
                                                <div class="meta"><?php echo $rowrevwsall['datetime']; ?></div>
                                                <?php $starsrv = $rowrevwsall['rating'];
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $starsrv) {
                                                            ?>
                                                            <a style="color:blue">★</a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a style="color:#f79f24">★</a>
                                                            <?php
                                                        }

                                                    }


                                                ?>

                                                <p><?php echo $rowrevwsall['review']; ?></p>
                                                <!-- <p><a href="#" class="reply">Reply</a></p> -->
                                            </div>
                                        </li>
                                        <?php
                                    }
                                ?>


                            </ul>
                            <!-- END comment-list -->
                            <?php
                                if (!($countrevws > 0)) {
                                    ?>
                                    <div class="comment-form-wrap pt-5">
                                        <h3 class="mb-5">Leave a comment</h3>
                                        <form method="post" class="p-5 bg-light">
                                            <div class="form-group">
                                                <label for="name">Rating *</label>
                                                <a href="javascript:void(0)" id="star1">★</a>
                                                <a href="javascript:void(0)" id="star2">★</a>
                                                <a href="javascript:void(0)" id="star3">★</a>
                                                <a href="javascript:void(0)" id="star4">★</a>
                                                <a href="javascript:void(0)" id="star5">★</a>
                                                <input type="text" name="rating" id="rating" hidden>
                                            </div>

                                            <input type="text" name="prdidrv" id="prdidrv"
                                                   value="<?php echo $rowviewprod['id']; ?>" hidden>
                                            <div class="form-group">
                                                <label for="message">Message</label>
                                                <textarea name="messagerev" id="message" cols="30" rows="10" required
                                                          class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Post Comment" name="postcomment"
                                                       id="postcomment" class="btn py-3 px-4 btn-primary">
                                            </div>

                                        </form>
                                    </div>
                                    <?php
                                }
                            ?>


                        </div>
                    </div>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

                    <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet"/>

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            $("#postcomment").click(function (event) {
                                var rat = $("#rating").val();

                                if (rat == "") {
                                    event.preventDefault();


                                    swal({
                                        title: "",
                                        text: "Please Select a Rating",

                                        closeOnClickOutside: false,
                                    })


                                }
                            });
                            $("#star1").click(function () {
                                $("#star1").css("color", "blue");
                                $("#star2").css("color", "#f79f24");
                                $("#star3").css("color", "#f79f24");
                                $("#star4").css("color", "#f79f24");
                                $("#star5").css("color", "#f79f24");
                                $("#rating").val(1);
                            });

                            $("#star2").click(function () {
                                $("#star1").css("color", "blue");
                                $("#star2").css("color", "blue");
                                $("#star3").css("color", "#f79f24");
                                $("#star4").css("color", "#f79f24");
                                $("#star5").css("color", "#f79f24");
                                $("#rating").val(2);
                            });

                            $("#star3").click(function () {
                                $("#star1").css("color", "blue");
                                $("#star2").css("color", "blue");
                                $("#star3").css("color", "blue");
                                $("#star4").css("color", "#f79f24");
                                $("#star5").css("color", "#f79f24");
                                $("#rating").val(3);
                            });


                            $("#star4").click(function () {
                                $("#star1").css("color", "blue");
                                $("#star2").css("color", "blue");
                                $("#star3").css("color", "blue");
                                $("#star4").css("color", "blue");
                                $("#star5").css("color", "#f79f24");
                                $("#rating").val(4);
                            });

                            $("#star5").click(function () {
                                $("#star1").css("color", "blue");
                                $("#star2").css("color", "blue");
                                $("#star3").css("color", "blue");
                                $("#star4").css("color", "blue");
                                $("#star5").css("color", "blue");
                                $("#rating").val(5);
                            });
                        });
                    </script>


                    <script>
                        function openCity(evt, cityName) {
                            var i, tabcontent, tablinks;
                            tabcontent = document.getElementsByClassName("tabcontent");
                            for (i = 0; i < tabcontent.length; i++) {
                                tabcontent[i].style.display = "none";
                            }
                            tablinks = document.getElementsByClassName("tablinks");
                            for (i = 0; i < tablinks.length; i++) {
                                tablinks[i].className = tablinks[i].className.replace(" active", "");
                            }
                            document.getElementById(cityName).style.display = "block";
                            evt.currentTarget.className += " active";
                        }
                    </script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            $("#london").click();
                        });
                    </script>


                </div> <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar pl-lg-5 ftco-animate">


                    <div class="sidebar-box ftco-animate">
                        <h3>Tags</h3>
                        <div class="tagcloud">
                            <?php
                                $tagsfr = $rowviewprod['tags'];
                                $tagfrarr = explode(",", $tagsfr);
                                foreach ($tagfrarr as $itmtag) {
                                    ?>
                                    <a href="javascript:void(0)" class="tag-cloud-link"><?php echo $itmtag; ?></a>
                                    <?php
                                }
                            ?>


                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <p style="color:black"><a class="plusminus" href="javascript:void(0)" id="minus"
                                                  style="    line-height: initial;border: none;    margin-right: 5px;">-</a><span
                                    id="spancount"><?php if ($qntycartchk > 1) {
                                    echo $qntycartchk;
                                } else {
                                    echo '1';
                                } ?></span><a class="plusminus" id="plus" href="javascript:void(0)"
                                              style="    line-height: initial;border: none;    margin-left: 5px;">+</a>
                        </p>
                        <input type="text" value="<?php if ($qntycartchk > 1) {
                            echo $qntycartchk;
                        } else {
                            echo '1';
                        } ?>" id="inpcount" hidden>
                        <h3><span style="color:green">₹ <?php echo $rowviewprod['saleprice']; ?></span> - <span
                                    style="text-decoration: line-through;">₹ <?php echo $rowviewprod['actualprice']; ?></span>
                        </h3>
                        <p style="color:red"><a href="tel:+91 8770772802">Call Here || For Order</a></p>

                        <p><a type="button" class="btn btn-<?php if ($countwishchk > 0) {
                                echo 'success';
                            } else {
                                echo 'danger';
                            } ?>" id="addtowishlist<?php echo $rowviewprod['id']; ?>"><i class="fa fa-heart"
                                                                                         aria-hidden="true"
                                                                                         style="color:white"></i></a>
                            <button type="button" class="btn btn-<?php if ($countcrtchk > 0) {
                                echo 'success';
                            } else {
                                echo 'primary';
                            } ?>" id="addtocart<?php echo $rowviewprod['id']; ?>"><?php if ($countcrtchk > 0) {
                                    echo 'Added';
                                } else {
                                    echo 'Add to Cart';
                                } ?></button>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section> <!-- .section -->

<?php

    while ($rowallprd = mysqli_fetch_assoc($resallprd)) {
        ?>
        <script>
            $(document).ready(function () {

                $("#minus").unbind("click").click(function () {
                    var valinpcount = $("#inpcount").val();
                    if (!((valinpcount - 1) < 1)) {
                        valinpcount--;
                    }
                    $("#inpcount").val(valinpcount);
                    $("#spancount").html(valinpcount);
                });

                $("#plus").unbind("click").click(function () {
                    /*alert();*/
                    var valinpcount = $("#inpcount").val();
                    valinpcount++;
                    $("#inpcount").val(valinpcount);
                    $("#spancount").html(valinpcount);
                });


                $("#addtocart<?php echo $rowallprd['id'];?>").click(function () {
                    var ip = "<?php echo $ip;?>";
                    var userid = "<?php echo $_SESSION["sessid"];?>";
                    var prdid = "<?php echo $rowallprd['id'];?>";
                    var qnty = $("#inpcount").val();
                    var idcartchk = "<?php echo $idcartchk;?>";
                    $.ajax({
                        type: "POST",
                        url: "subfunctions/addtocartforviewproduct.php",
                        data: {
                            userid: userid,
                            ip: ip,
                            prdid: prdid,
                            qnty: qnty,
                            idcartchk: idcartchk,
                            action: 'alertquerydf'
                        },
                        success: function (result) {
                            $('#addtocart<?php echo $rowallprd['id'];?>').html(result);
                            $('#addtocart<?php echo $rowallprd['id'];?>').attr('class', 'btn btn-success');


                        }
                    });


                });

                $("#addtowishlist<?php echo $rowallprd['id'];?>").click(function () {
                    var ip = "<?php echo $ip;?>";
                    var userid = "<?php echo $_SESSION["sessid"];?>";
                    var prdid = "<?php echo $rowallprd['id'];?>";
                    var qnty = $("#inpcount").val();
                    var idcartchk = "<?php echo $idcartchk;?>";
                    $.ajax({
                        type: "POST",
                        url: "subfunctions/addtowishlistforviewproduct.php",
                        data: {
                            userid: userid,
                            ip: ip,
                            prdid: prdid,
                            qnty: qnty,
                            idcartchk: idcartchk,
                            action: 'alertquerydf'
                        },
                        success: function (result) {

                            $('#addtowishlist<?php echo $rowallprd['id'];?>').attr('class', 'btn btn-success');


                        }
                    });


                });


            });
        </script>

        <?php
    }
?>

<?php
    include('footer.php');
?>