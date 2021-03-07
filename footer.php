<style>
    .ftco-footer-widget.mb-4.ml-md-5 {
        width: max-content;
    }

    li.ftco-animate.fadeInUp.ftco-animated {
        width: 10%;
    }

    .ftco-footer-social li {

        margin: 0 30px 0 0 !important;

    }
</style>


<footer class="footer ftco-section sm_footer_extra">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-4 col-lg">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="logo"><a href="/"><img src="images/logo.png"
                                                      style="height:68px;width:112px;    margin-top: -67px;position: absolute;"><span></span></a>
                    </h2>
                    <p>Power is in your hands, to help us improvise time to time, through our feedback system.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-4">
                        <li class="ftco-animate"><a href="https://www.twitter.com/omg_oct2019"><span
                                        class="fa fa-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="https://www.facebook.com/omgoct2019"><span
                                        class="fa fa-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="https://www.instagram.com/omgoct2019/"><span
                                        class="fa fa-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-lg">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">About US</h2>
                    <ul class="list-unstyled">
                        <li><a href="about.php" class="py-1 d-block"><span class="fa fa-check mr-3"></span>About US</a>
                        </li>
                        <li><a href="careers.php" class="py-1 d-block"><span class="fa fa-check mr-3"></span>Careers</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-lg">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Support</h2>
                    <ul class="list-unstyled">
                        <li><a href="complain.php" class="py-1 d-block"><span
                                        class="fa fa-check mr-3"></span>Complain</a></li>
                        <li><a href="support.php" class="py-1 d-block"><span class="fa fa-check mr-3"></span>Support</a>
                        </li>
                        <li><a href="faq.php" class="py-1 d-block"><span class="fa fa-check mr-3"></span>FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-lg">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Services</h2>
                    <ul class="list-unstyled">
                        <?php
                        while ($rowcath1 = mysqli_fetch_assoc($rescath1)) {
                            ?>
                            <li><a href="moreservices.php?catid=<?php echo $rowcath1['id']; ?>"
                                   class="py-1 d-block"><span
                                            class="fa fa-check mr-3"></span><?php echo $rowcath1['name']; ?></a></li>
                            <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-lg">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Reach US</h2>
                    <ul class="list-unstyled">
                        <li><a href="contact.php" class="py-1 d-block"><span class="fa fa-check mr-3"></span>Contact US</a>
                        </li>
                        <li><a href="hire.php" class="py-1 d-block"><span class="fa fa-check mr-3"></span>Hire US</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-lg">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Our Policy</h2>
                    <ul class="list-unstyled">
                        <li><a href="terms.php" class="py-1 d-block"><span class="fa fa-check mr-3"></span>Terms &
                                Conditions</a></li>
                        <li><a href="privacypolicy.php" class="py-1 d-block"><span class="fa fa-check mr-3"></span>Privacy
                                Policy</a></li>
                        <!-- <li><a href="sitemap.php" class="py-1 d-block"><span class="fa fa-check mr-3"></span>SiteMap</a></li> -->
                    </ul>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 text-center">

                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                    All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by
                    <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>
        </div>
    </div>
</footer>


<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00"/>
    </svg>
</div>


<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.timepicker.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/scrollax.min.js"></script>

<script src="js/main.js"></script>

</body>
</html>