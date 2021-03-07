<?php
    include('header.php');
?>
    <style>
        .ftco-appointment .half {

            background: #f79f24 !important;
        }

        #vl {
            border-left: 3px solid #202020;
            height: 350px;
            position: absolute;
            left: 50%;
            margin-left: -4px;
            top: 10px;
        }

        @media (min-width: 1200px) {
            .container.register {
                max-width: 622px !important;
            }
        }

        .p-3 {
            padding: 3rem !important;
        }

    </style>
    <section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb img" style="margin-bottom: 20px;">
        <!-- <div class="overlay"></div> -->
        <div class="container register">
            <div class="row d-md-flex justify-content-end">
                <div class="col-md-12 col-lg-12 half p-3 py-5 pl-lg-5 ftco-animate heading-section heading-section-white">
                    <h2 class="mb-4"><span class="fa fa-sign-in"></span> Login</h2>
                    <form method="post" class="appointment">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="UserName or Email" name="uname"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                           required>
                                </div>
                            </div>

                            <h6 class="mb-4"><a href="forgotpassword.php" style="color: #007bff;">Lost your
                                    Password?</a></h6>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Login" name="btnLogin" class="btn btn-dark py-3 px-4">
                                </div>
                            </div>
                            <h6 class="col-md-12" style="color:white;text-align: center">New User? <a
                                        style="color:purple !important;" href="register.php">Register</a></h6>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </section>
<?php
    include('footer.php');
?>