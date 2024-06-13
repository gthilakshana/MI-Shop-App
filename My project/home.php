<?php


require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MI shop | Home</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <style>
        * {
            box-sizing: border-box;
        }

        .zoom {


            transition: transform .2s;
            width: 200px;
            height: 200px;
            margin: 0 auto;
            cursor: pointer;
        }

        .zoom:hover {
            -ms-transform: scale(1.5);
            /* IE 9 */
            -webkit-transform: scale(1.5);
            /* Safari 3-8 */
            transform: scale(1.5);
        }

        /* media queries  */

        @media (max-width:995px) {

            html {
                font-size: 60%;
            }

            .header {
                padding: 2rem;
            }

            section {
                padding: 2rem;
            }

        }
    </style>
</head>

<body>

    <?php
    require "header3.php";
    ?>



    <?php

    require "nav.php";

    ?>






    <div class="loader_bg">
        <div class="loader"></div>
    </div>



    <div class="container-fluid ">
        <div class="row ">

            <?php

            require "header.php";

            ?>



            <div class=" col-12 justify-content-center ">
                <div class="row mb-3 backg1">

                    <div class="col-4 col-lg-1 offset-4 offset-lg-1 "></div>

                    <div class="col-8 col-md-5 col-lg-6">
                        <div class="input-group input-group-lg mt-3 mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">

                            <select class="col-3 btn btn-outline-light" id="basic_search_select">
                                <option value="0" readonly>Select</option>

                                <?php

                                $rs = Database::search("SELECT * FROM `category`");
                                $n = $rs->num_rows;

                                for ($x = 0; $x < $n; $x++) {
                                    $fa = $rs->fetch_assoc();

                                ?>

                                    <option value="<?php echo $fa["id"]; ?>" readonly><?php echo $fa["name"]; ?></option>

                                <?php
                                }

                                ?>

                            </select>

                        </div>
                    </div>

                    <div class="col-2 d-grid gap-2">
                        <button class="btn btn-light mt-4 search-btn" onclick="basicSearch(0);"> Search</button>
                    </div>

                    <div class="col-2 mt-4">
                        <a href="http://localhost/my%20project/advancedSearch.php" class="link-light link-1"> Advanced</a>
                    </div>

                </div>
            </div>




            <hr class="hr-break-1" />
            <div class="col-12" id="basicSearchResult">

                <!-- Carousel Start -->
                <?php

                require "slider.php";

                ?>
                <!-- Carousel End -->
                <hr class="hr-break-1" />




                <!-- About Start -->
                <div class="container-fluid py-5 backg">
                    <div class="container py-5">
                        <div class="row align-items-center">
                            <div class="col-lg-5 ">
                                <img class="img-fluid rounded mb-4 mb-lg-0" src="img/freestocks.jpg" alt="">
                            </div>
                            <div class="col-lg-7">
                                <div class="text-left mb-4">
                                    <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;"><b>About Us</b></h5>
                                    <h1 class="text-light"><b>MI SHOP</b></h1>
                                </div>
                                <p class="text-light"><b>
                                        In November 2020, India's Ministry of Electronics and Information Technology banned the AliExpress mobile phone app and 42 other apps from China


                                    </b></p>
                                <a href="http://localhost/my%20project/description.html" class="btn btn-warning py-md-2 px-md-4 font-weight-semi-bold mt-2">Learn More</a>
                                <?php

                                require "login.php";

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- About End -->

                <hr class="hr-break-3" />
                <hr class="hr-break-3" />

                <script>
                    var slideIndex = 1;
                    showDivs(slideIndex);

                    function plusDivs(n) {
                        showDivs(slideIndex += n);
                    }

                    function showDivs(n) {
                        var i;
                        var x = document.getElementsByClassName("mySlides");
                        if (n > x.length) {
                            slideIndex = 1
                        }
                        if (n < 1) {
                            slideIndex = x.length
                        }
                        for (i = 0; i < x.length; i++) {
                            x[i].style.display = "none";
                        }
                        x[slideIndex - 1].style.display = "block";
                    }
                </script>

            </div>
        </div>
    </div>

    <?php

    $rs = Database::search("SELECT * FROM `category`");
    $n = $rs->num_rows;

    for ($x = 0; $x < $n; $x++) {
        $cat = $rs->fetch_assoc();

    ?>

        <!-- Category name-->
        <div class="col-12 container ">
            <a href="#" class="link-Warning link2"><?php echo $cat["name"]; ?></a>&nbsp; &rarr;
            <a href="#" class="link-Warning link3">See All&nbsp; &rarr;</a>
        </div>
        <!-- Category name-->

        <?php

        $resultset = Database::search("SELECT * FROM `product` WHERE `category` = '" . $cat["id"] . "' ORDER BY `date_time_added` DESC LIMIT 4 OFFSET 0");
        $norows = $resultset->num_rows;


        ?>

        <!-- Products-->

        <div class="col-12 mb-3">

            <div class="row border border-dark">

                <div class="col-12 col-lg-12 ">

                    <div class="row justify-content-center gap-2 ">

                        <?php

                        for ($y = 0; $y < $norows; $y++) {
                            $product = $resultset->fetch_assoc();

                        ?>

                            <div class="card col-6 col-lg-2 mt-2 mb-2 " style="width: 20rem; ">

                                <?php

                                $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "'");
                                $img = $pimage->fetch_assoc();

                                ?>

                                <img class="xzoom-pre zoom" src="<?php echo $img["code"]; ?>" class="card-img-top card-img-top xzoom">
                                <div class="card-body ms-0 m-0">
                                    <h5 class="card-title"><?php echo $product["title"]; ?><span class="badge bg-info ">New</span></h6>
                                    </h5>
                                    <span class="card-text text-primary">Rs. <?php echo $product["price"]; ?></span>
                                    <br />

                                    <?php

                                    if ($product["qty"] > 0) {

                                    ?>

                                        <span class="card-text text-warning "><b>In stock</b></span>
                                        <br>
                                        <span class="card-text text-success fw-bold"><?php echo $product["qty"]; ?></span>
                                        <a href='<?php echo "singleProductView.php?id=" . ($product["id"]) ?>' class="btn btn-warning col-12">Buy Now</a>
                                        <a href="#" class="btn btn-dark col-12 mt-1">Add to Cart</a>

                                    <?php

                                    } else {

                                    ?>

                                        <span class="card-text text-danger "><b>Out of stock</b></span>
                                        <br>
                                        <span class="card-text text-danger fw-bold">0 Items Available</span>
                                        <a href="#" class="btn btn-success col-12 disabled">Buy Now</a>
                                        <a href="#" class="btn btn-danger col-12 mt-1 disabled">Add to Cart</a>

                                        <?php
                                    }

                                    if (isset($_SESSION["u"])) {
                                        $usd = $_SESSION["u"]["email"];

                                        $watchrs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $product["id"] . "'
                                        AND `user_email`='" . $usd . "'");

                                        if ($watchrs->num_rows == 1) {
                                        ?>

                                            <a onclick='addToWatchlist(<?php echo $product["id"]; ?>);' class="btn btn-secondary col-12 mt-1"><i class="bi bi-heart-fill fs-5 text-danger" id="heart<?php echo $product["id"]; ?>"></i></a>

                                        <?php
                                        } else {
                                        ?>

                                            <a onclick='addToWatchlist(<?php echo $product["id"]; ?>);' class="btn btn-secondary col-12 mt-1"><i class="bi bi-heart-fill fs-5" id="heart<?php echo $product["id"]; ?>"></i></a>

                                        <?php
                                        }
                                    } else {
                                        ?>

                                        <a onclick="watchlist();" class="btn btn-secondary col-12 mt-1"><i class="bi bi-heart-fill fs-5"></i></a>

                                    <?php
                                    }

                                    ?>



                                </div>
                            </div>

                        <?php

                        }

                        ?>
                    </div>

                </div>

            </div>

        </div>

        <!-- Products-->

    <?php
    }

    ?>
    <hr>




    <hr>






    <?php

    require "footer.php";

    ?>

    </div>

    </div>
    <script src="script.js"></script>
    <script src="zoomsl.js"></script>
    <script src="jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        setTimeout(function() {
            $('.loader_bg').fadeToggle();
        }, 1500);
    </script>
</body>

</html>