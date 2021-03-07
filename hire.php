<?php
include('header.php');
?>
    <section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb img"
             style="background-image: url(images/Hire-Soshable.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row d-md-flex justify-content-end">
                <div class="col-md-12 col-lg-6 half p-3 py-5 pl-lg-5 ftco-animate heading-section heading-section-white">
                    <span class="subheading">Booking an Appointment</span>
                    <h2 class="mb-4">Free Consultation</h2>
                    <form method="post" class="appointment">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                            <select name="service" id="" class="form-control">
                                                <option value="" selected disabled>Select services</option>
                                                <?php
                                                while ($rowcat = mysqli_fetch_assoc($rescat)) {
                                                    ?>
                                                    <option value="<?php echo $rowcat['name']; ?>"><?php echo $rowcat['name']; ?></option>
                                                    <?php
                                                }
                                                ?>


                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <div class="input-wrap">
                                        <div class="icon"><span class="fa fa-calendar"></span></div>
                                        <input type="text" class="form-control appointment_date" name="date"
                                               placeholder="Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <div class="icon"><span class="fa fa-clock-o"></span></div>
                                        <input type="text" class="form-control appointment_time" name="time"
                                               placeholder="Time">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Why you want to Hire US"
                                           name="reason" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- <textarea  id="" cols="30" rows="7" class="form-control" placeholder="Message" name="message">
                                    </textarea> -->
                                    <textarea cols="30" rows="5" rows="4" cols="50" class="form-control" name="message"
                                              placeholder="Please specify your Instructions"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Send message" name="btnHire"
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