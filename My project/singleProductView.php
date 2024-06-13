<?php


require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $productrs = Database::search("SELECT product.id,product.category,product.model_has_brand_id,
    product.colour_id,product.price,product.qty,product.description,product.title,product.condition_id,
    product.status_id,product.user_email,product.date_time_added,product.delivery_free_colombo,
    product.delivery_free_other,model.name AS `mname`,brand.name AS `bname` FROM product INNER JOIN 
    model_has_brand ON model_has_brand.id=product.model_has_brand_id INNER JOIN brand ON
    brand.id=model_has_brand.brand_id INNER JOIN model ON model_has_brand.model_id=model.id WHERE
    product.id='" . $pid . "'");

    $pn = $productrs->num_rows;

    if ($pn == 1) {

        $pd = $productrs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html>

        <head>
            <title>MI SHOP | Single Product View</title>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1" />

            <link rel="icon" href="resources/logo.svg" />
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

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
            </style>

        </head>

        <body>

            <?php
            require "header3.php";
            ?>

            <?php

            require "nav.php";

            ?>


            <div class="container-fluid">
                <div class="row">

                    <?php

                    require "header.php";

                    ?>

                    <hr>

                    <div class="col-12 mt-0 singleproduct">
                        <div class="row">

                            <div class="blackg" style="padding: 11px;">
                                <div class="row">

                                    <div class="col-lg-2 order-lg-1 order-2">

                                        <ul>
                                            <?php

                                            $title = $pd["title"];
                                            $imagers = Database::search("SELECT * FROM images INNER JOIN product ON
                                            product.id=images.product_id WHERE product.title='" . $title . "'");

                                            $in = $imagers->num_rows;
                                            $img;

                                            if (!empty($in)) {
                                                for ($x = 0; $x < $in; $x++) {
                                                    $d = $imagers->fetch_assoc();
                                                    if ($x == 0) {
                                                        $img = $d["code"];
                                                    }

                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-light mb-1 br">
                                                        <img src="<?php echo $d["code"]; ?>" height="150px" class="mt-1 mb-1 zoom" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);" />
                                                    </li>
                                                <?php

                                                }
                                            } else {
                                                ?>

                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-light mb-1">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-light mb-1">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-light">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>

                                            <?php
                                            }

                                            ?>


                                        </ul>

                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block xzoom">
                                        <div class="align-items-center border border-1 border-light br ">

                                            <div style="background-image: url('<?php echo $img ?>'); background-repeat: no-repeat; background-size: contain; height: 480px;" id="mainimg"></div>

                                        </div>
                                    </div>

                                    <div class="col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">

                                                <nav class="">
                                                    <ol class="d-flex flex-wrap mb-0 list-unstyled">
                                                        <li class="breadcrumb-item ">
                                                            <a href="http://localhost/my%20project/home.php#">Home</a>
                                                        </li>
                                                        <li class="breadcrumb-item">
                                                            <a href="#" class="text-decoration-none text-light fw-bold"> Single Product View</a>
                                                        </li>
                                                    </ol>
                                                </nav>

                                                <hr>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fs-4  fw-bold mt-0 text-dark"><?php echo $pd["title"] ?></label>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <span class="badge">
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star-half mt-1 text-warning fs-6"></i>

                                                        <label class="text-dark fs-6">4.5 Stars</label>
                                                        <label class="text-dark fs-6">35 | 35 Ratings & Reviews</label>
                                                    </span>
                                                </div>

                                                <div class="col-12 d-inline-block">
                                                    <label class="fw-bold fs-4 mt-1 text-dark" id="unitprice">Rs. <?php echo $pd["price"] ?> .00</label>&nbsp;&nbsp;&nbsp;
                                                    <label class="fw-bold fs-6 mt-1 text-danger"><del>Rs. <?php $p = $pd["price"];
                                                                                                            $n = ($pd["price"] / 100) * 5;
                                                                                                            $newval = $p + $n;
                                                                                                            echo $newval ?> .00</del></label>
                                                </div>

                                                <hr class="hr-break-1" />

                                                <div class="col-12">
                                                    <label class="text-dark fs-6 fw-bold">Warrenty : 06 month warrenty</label> <br />
                                                    <label class="text-dark fs-6"><b>Return Policy :</b>01 month return policy</label> <br />
                                                    <label class="text-dark fs-6"><b class="text-success">In Stock :</b><?php echo $pd["qty"] ?> Items left</label>
                                                </div>

                                                <hr class="hr-break-1" />

                                                <div class="col-12">

                                                    <?php

                                                    $userrs = Database::search("SELECT * FROM user WHERE `email`='" . $pd["user_email"] . "'");
                                                    $userd = $userrs->fetch_assoc();

                                                    ?>

                                                    <label class="text-dark fs-3 fw-bold mb-3">Seller's Details</label> <br />
                                                    <label class="text-dark fs-6 ">Seller's Name : <?php echo $userd["fname"] . " " . $userd["lname"] ?></label> <br />
                                                    <label class="text-dark fs-6 ">Seller's Email : <?php echo $userd["email"] ?></label> <br />
                                                    <label class="text-dark fs-6 ">Seller's Mobile : <?php echo $userd["mobile"] ?></label> <br />
                                                </div>

                                                <hr class="hr-break-1" />

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-lg-8 rounded border border-1 border-dark mt-1 pt-2 classwhite">
                                                            <div class="row">
                                                                <div class="col-md-3 col-sm-3 col-lg-1">
                                                                    <img src="resources/pricetag.png.jpeg" height="70%" />
                                                                </div>
                                                                <div class="col-md-9 col-sm-9 mt-1 pe-4 col-lg-11">
                                                                    <label class="mt-2">Stand a chance to get instant 5% discount by using VISA.</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-6" style="margin-top: 15px;">
                                                            <div class="row">
                                                            <div class="border border-1 border-secondary rounded overflow-hidden float-start mt-1 position-relative product_qty">
                                                                    <div class="col-12">
                                                                        <span>Qty :</span>

                                                                        <input id="qtyinput" type="text" class="border-0 fs-6 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" onkeyup='check_val(<?php echo $pd["qty"]; ?>);' />

                                                                        <div class="position-absolute qty_buttons">
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_inc">
                                                                                <i class="fas fa-chevron-up" onclick='qty_inc(<?php echo $pd["qty"]; ?>);'></i>
                                                                            </div>

                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_dec">
                                                                                <i class="fas fa-chevron-down" onclick="qty_dec()"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 mt-3">
                                                                    <div class="row">

                                                                        <div class="col-4 col-lg-5 d-grid">
                                                                            <button class="btn btn-dark">Add To Cart</button>
                                                                        </div>

                                                                        <div class="col-4 col-lg-5 d-grid">
                                                                            <button class="btn btn-warning" onclick="buynow('<?php echo $pid;?>')">Buy Now</button> 
                                                                        </div>

                                                                        <div class="col-4 col-lg-2 d-grid">
                                                                            <button class="btn btn-light"><i class="fas fa-heart fs-4 mt-1"></i></button>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 bg">
                                    <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-dark">
                                        <div class="col-md-6">
                                            <span class="fs-3 fw-bold text-dark">Related Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 bg-white">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row p-2" style="text-align: justify;">

                                                <?php

                                                $prod = Database::search("SELECT * FROM `product` WHERE `model_has_brand_id`='" . $pd["model_has_brand_id"] . "'
                                             LIMIT 5");

                                                $bds = $prod->num_rows;

                                                for ($y = 0; $y < $bds; $y++) {
                                                    $pdf = $prod->fetch_assoc();

                                                ?>

                                                    <div class="card me-1" style="width: 18rem;">

                                                        <?php

                                                        $pimgrs = Database::search("SELECT * FROM images WHERE `product_id`='" . $pdf["id"] . "'");
                                                        $pimgf = $pimgrs->fetch_assoc();

                                                        ?>
                                                        <img src="<?php echo $pimgf["code"]; ?>" class="card-img-top" alt="..." />
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo $pdf["title"]; ?></h5>
                                                            <p class="card-text"><?php echo $pdf["price"]; ?></p>
                                                            <a href="#" class="btn btn-warning fsm2">Buy Now</a>
                                                            <a href="#" class="btn btn-dark fsm2">Add cart</a>
                                                            &nbsp;
                                                            <a href="#" class="mt-2 fs-6"><i class="fas fa-heart mt-1 fs-4 text-black-50"></i></a>
                                                        </div>
                                                    </div>

                                                <?php

                                                }

                                                ?>







                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-6 col-lg-6 bg-white">
                                            <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                                <div class="col-md-6">
                                                    <span class="fs-3 fw-bold">Product Details</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 col-lg-6 bg-white">
                                            <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                                <div class="col-md-6">
                                                    <span class="fs-3 fw-bold">Send Feedback</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-6 bg-white border border-1 border-secondary">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <label class="form-label fw-bold">Brand</label>
                                                        </div>
                                                        <div class="col-10">
                                                            <label class="form-label fw-bold"><?php echo $pd["bname"]; ?></label>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-2">
                                                            <label class="form-label fw-bold">Model</label>
                                                        </div>
                                                        <div class="col-10">
                                                            <label class="form-label fw-bold"><?php echo $pd["mname"]; ?></label>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-2">
                                                            <label class="form-label fw-bold">Description</label>
                                                        </div>
                                                        <div class="col-10">
                                                            <textarea class="form-label" cols="60" rows="10" disabled><?php echo $pd["description"]; ?></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 border border-1 border-secondary">
                                            <div class="row">
                                                <div class="col-12 mt-3">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-3 fw-bold">
                                                            <label>Feedback Type</label>
                                                        </div>
                                                        <div class="col-12 col-lg-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="r1" checked>
                                                                <label class="form-check-label text-success fw-bold" for="r1">
                                                                    Positive
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-lg-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="r2">
                                                                <label class="form-check-label text-warning fw-bold" for="r2">
                                                                    Neutral
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-lg-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="r3">
                                                                <label class="form-check-label text-danger fw-bold" for="r3">
                                                                    Negative
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="form-label fw-bold">Customer's Email</label>
                                                        </div>
                                                        <div class="col-8">
                                                            <input id="e" type="email" class="form-control" value="<?php echo $_SESSION["u"]["email"] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="form-label fw-bold">Customer's Feedback</label>
                                                        </div>
                                                        <div class="col-8">
                                                            <textarea cols="30" rows="8" class="form-control" id="f"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="offset-lg-3 col-12 col-lg-8 d-grid mt-2 mb-3">
                                                    <button class="btn btn-outline-dark" onclick="saveFeed(<?php echo $pid; ?>);">Send Feedback</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class=" col-12">
                                    <hr class="border-secondary" />
                                </div>

                                <div class="col-12 overflow-auto">
                                    <div class="row g-2">

                                        <?php

                                        $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                                        $feedback_num = $feedback_rs->num_rows;

                                        for ($x = 0; $x < $feedback_num; $x++) {
                                            $feedback_data = $feedback_rs->fetch_assoc();

                                        ?>

                                            <div class="col-12 col-lg-3 bg-white border border-1 border-danger rounded">
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <span class="fs-5 fw-bold text-primary">Gavrawa Thilakshana</span>
                                                        <br />
                                                        <span class="fs-6 fw-bold text-secondary"><?php echo $feedback_data["user_email"] ?></span>
                                                    </div>

                                                    <div class="mt-2 offset-1 col-10 text-center border border-1 border-warning rounded overflow-auto" style="height:100px ;">
                                                        <p class="fs-6 text-black">
                                                            <?php echo $feedback_data["feed"] ?>
                                                        </p>
                                                    </div>

                                                    <div class="col-12 text-center mt-2">
                                                        <span class="fs-6 text-black-50 fw-bold"><?php echo $feedback_data["date"] ?></span>
                                                    </div>

                                                    <div class="col-12 mt-3 mb-3 mb-3">
                                                        <div class="row">

                                                            <?php

                                                            if ($feedback_data["type"] == "1") {

                                                            ?>

                                                                <div class="offset-1 col-10 bg-success text-center">
                                                                    <span class="fs-5 fw-bold text-white">Posiive feedback</span>
                                                                </div>
                                                            <?php

                                                            } else if ($feedback_data["type"] == "2") {

                                                            ?>

                                                                <div class="offset-1 col-10 bg-warning text-center">
                                                                    <span class="fs-5 fw-bold text-white">Nutral feedback</span>
                                                                </div>
                                                            <?php

                                                            } else if ($feedback_data["type"] == "3") {
                                                            ?>

                                                                <div class="offset-1 col-10 bg-danger text-center">
                                                                    <span class="fs-5 fw-bold text-white">Negetive feedback</span>
                                                                </div>
                                                            <?php
                                                            }

                                                            ?>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php

                                        }

                                        ?>


                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <?php require "footer.php"; ?>
            </div>

            <script src="script.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        </body>

        </html>

<?php

    }
} else {
}

?>