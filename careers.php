<?php
    include('header.php');
?>
    <section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb img"
             style="background-image: url(images/career.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row d-md-flex justify-content-end">
                <div class="col-md-12 col-lg-6 half p-3 py-5 pl-lg-5 ftco-animate heading-section heading-section-white">
                    <span class="subheading">Booking an Appointment</span>
                    <h2 class="mb-4">Free Consultation</h2>
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
                                    <input type="text" class="form-control" placeholder="Your Phone Number"
                                           name="phoneno" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email" name="email"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Educational Qualification"
                                           name="education" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Address" name="address"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Work Experience" name="workexp"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Previous Salary" name="prevsal"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Expected Salary" name="expsal"
                                           required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- <textarea    class="form-control"  placeholder="">
                                    </textarea> -->
                                    <textarea cols="30" rows="5" rows="4" cols="50" class="form-control" name="message"
                                              placeholder="Tell us about yourself. Your Previous Job Role etc"></textarea>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Submit Now" class="btn btn-dark py-3 px-4"
                                           name="btnCareer">
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