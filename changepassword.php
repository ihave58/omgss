<?php
include('header.php');
if ($_SESSION["sessid"] == "") {
    echo '<script>window.location.href="index.php";</script>';
}
?>
    <style>
        .w3-sidebar {
            height: 1000px !important;
        }
    </style>
    <link rel="stylesheet" href="css/w3.css">

    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left"
         style="width:217px; background: #0071ff;    color: white;     padding-top: 35px;" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
        <?php
        include('sidebar.php');
        ?>
    </div>

    <div class="w3-main" style="margin-left:200px; "><!--  height: 500px !important; -->
        <div class="w3-teal" style="background-color: #f79f24!important;">
            <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h1 style="margin-left: 33px;color: white;">Change Password</h1>
            </div>
        </div>

        <div class="w3-container">


            <section class="ftco-section bg-light">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="wrapper">
                                <div class="row no-gutters">
                                    <div class="col-md-7 d-flex">
                                        <div class="contact-wrap w-100 p-md-5 p-4">
                                            <form method="POST" id="contactForm" class="contactForm">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label> Old Password: </label>
                                                            <input type="password" class="form-control" name="opass"
                                                                   id="opass" placeholder="Old Password">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label> New Password: </label>
                                                            <input type="password" class="form-control" name="npass"
                                                                   id="npass" placeholder="New Password">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label> Confirm Password: </label>
                                                            <input type="password" class="form-control" name="cpass"
                                                                   id="cpass" placeholder="Confirm Password">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="submit" name="resspassfront" value="Update"
                                                                   class="btn btn-primary">
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


        </div>

    </div>

    <script>
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
        }
    </script>

<?php
include('footer.php');
?>