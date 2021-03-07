<?php
    include('header.php');
?>
    <section class="hero-wrap hero-wrap-2"
             style="background-image: url('admin/files/extras/<?php echo $rowterms['image']; ?>');"
             data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i
                                        class="fa fa-chevron-right"></i></a></span> <span>Terms & Conditions <i
                                    class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Terms & Conditions</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section ftco-no-pt ftco-no-pb bg-light">
        <div class="container">
            <div class="row d-flex no-gutters">

                <div class="col-md-12 pl-md-5">
                    <div class="row justify-content-start py-5">
                        <div class="col-md-12 heading-section ftco-animate">

                            <?php echo $rowterms['textterms']; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
    include('footer.php');
?>