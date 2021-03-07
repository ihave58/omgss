<?php
include('header.php');
?>
    <style>
        .collapsible {
            background-color: #777;
            color: white;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
        }

        .active, .collapsible:hover {
            background-color: cadetblue;
        }

        .content {
            padding: 0 18px;
            display: none;
            overflow: hidden;
            background-color: #f1f1f1;
        }
    </style>
    <section class="hero-wrap hero-wrap-2"
             style="background-image: url('admin/files/extras/<?php echo $rowfaqbanner['faqbanner']; ?>');"
             data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i
                                        class="fa fa-chevron-right"></i></a></span> <span>FAQ <i
                                    class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">FAQ</h1>
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


                            <?php
                            if ($countfaq > 0) {
                                while ($rowfaq = mysqli_fetch_assoc($resfaq)) {

                                    ?>


                                    <button type="button"
                                            class="collapsible"><?php echo $rowfaq['question']; ?></button>
                                    <div class="content">
                                        <p><?php echo $rowfaq['answer']; ?></p>
                                    </div>


                                    <?php
                                }
                            }
                            ?>


                            <script>
                                var coll = document.getElementsByClassName("collapsible");
                                var i;

                                for (i = 0; i < coll.length; i++) {
                                    coll[i].addEventListener("click", function () {
                                        this.classList.toggle("active");
                                        var content = this.nextElementSibling;
                                        if (content.style.display === "block") {
                                            content.style.display = "none";
                                        } else {
                                            content.style.display = "block";
                                        }
                                    });
                                }
                            </script>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
include('footer.php');
?>