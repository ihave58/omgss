<?php
    include('header.php');
?>
    <section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb img"
             style="background-image: url(images/complain.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row d-md-flex justify-content-end">
                <div class="col-md-12 col-lg-6 half p-3 py-5 pl-lg-5 ftco-animate heading-section heading-section-white">
                    <span class="subheading">Complain</span>
                    <h2 class="mb-4">For any issue feel free to contact</h2>
                    <form method="post" class="appointment">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name" name="name"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Contact" name="contactno"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="Email" class="form-control" placeholder="Your Email" name="email"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Address" name="address"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Complain Details Here"
                                           name="complainDetails" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">

                                    <textarea cols="30" rows="5" rows="4" cols="50" class="form-control" name="message"
                                              placeholder="Tell us about your Complain, We will solve soon."></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Submit" name="btnComplain"
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