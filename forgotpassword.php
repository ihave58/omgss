<?php
    include('header.php');
?>
    <section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb img"
             style="background-image: url(images/forgotpw.jpg);    margin-bottom: 10px;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row d-md-flex justify-content-end">
                <div class="col-md-12 col-lg-6 half p-3 py-5 pl-lg-5 ftco-animate heading-section heading-section-white">
                    <h2 class="mb-4">Forgot Password</h2>
                    <span class="subheading">Please enter your username or email address. You will receive an OTP  to create a new password.</span>

                    <form method="post" class="appointment">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="UserName or Email"
                                           name="recoverData" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Reset Password" name="respass"
                                           class="btn btn-dark py-3 px-4">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php
    include('footer.php');
?>