<?php

require "connection.php";

session_start();

$product = $_SESSION["p"];

if (isset($product)) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>MI SHOP |Update Products</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>

        <?php

        require "nav.php";

        ?>

        <?php

        require "header.php";

        ?>
        <hr>


        <div class="container-fluid">
            <div class="row gy-3">

                <div class="col-12">
                    <div class="col-12 mb-2">
                        <h3 class="h2 text-center text-dark fw-bold">Product Update</h3>
                    </div>
                    <hr>

                    <div class="col-lg-12">
                        <div class="row">

                            <span class="text-danger h5" id="msg"></span>
                            <span class="text-danger h5" id="msg2"></span>

                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Category</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="ca" disabled>

                                            <?php

                                            $category = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category"] . "'");
                                            $cd = $category->fetch_assoc();

                                            ?>

                                            <option value="0"><?php echo $cd["name"] ?></option>

                                        </select>
                                    </div>

                                </div>
                            </div>


                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Brand</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="br" disabled>

                                            <?php

                                            $brand = Database::search("SELECT * FROM `brand` WHERE `id` IN 
                                        (SELECT `brand_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "');");

                                            $bd = $brand->fetch_assoc();

                                            ?>

                                            <option value="0"><?php echo $bd["name"]; ?></option>

                                        </select>
                                    </div>

                                </div>
                            </div>


                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Model</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="mo" disabled>

                                            <?php

                                            $model = Database::search("SELECT * FROM `model` WHERE `id` IN 
                                        (SELECT `model_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "');");

                                            $md = $model->fetch_assoc();

                                            ?>
                                            <option value="0"><?php echo $md["name"]; ?></option>


                                        </select>
                                    </div>

                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Add a Title to your product</label>
                                    </div>
                                    <div class="offset-lg-2 col-12 col-lg-8">
                                        <input class="form-control" type="text" id="ti" value="<?php echo $product["title"]; ?>" />
                                    </div>
                                </div>
                            </div>

                            <hr class="hr-break-1" />

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lbl1">Select Product Condition</label>
                                            </div>
                                            <?php

                                            if ($product["condition_id"] == 1) {

                                            ?>
                                                <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" checked disabled />
                                                    <label class="form-check-label" for="bn">
                                                        Brandnew
                                                    </label>
                                                </div>
                                                <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="us" disabled />
                                                    <label class="form-check-label" for="us">
                                                        Used
                                                    </label>
                                                </div>

                                            <?php

                                            } else if ($product["condition_id"] == 2) {

                                            ?>
                                                <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" disabled />
                                                    <label class="form-check-label" for="bn">
                                                        Brandnew
                                                    </label>
                                                </div>
                                                <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="us" checked disabled />
                                                    <label class="form-check-label" for="us">
                                                        Used
                                                    </label>
                                                </div>
                                            <?php
                                            }

                                            ?>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lbl1">Select Product Colour</label>
                                            </div>

                                            <?php

                                            if ($product["colour_id"] == 1) {

                                            ?>

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                            <input class="form-check-input" type="radio" name="clrRadio" id="clr1" checked disabled />
                                                            <label class="form-check-label" for="clr1">
                                                                Gold
                                                            </label>
                                                        </div>
                                                        <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                            <input class="form-check-input" type="radio" name="clrRadio" id="clr2" disabled />
                                                            <label class="form-check-label" for="clr2">
                                                                Silver
                                                            </label>
                                                        </div>
                                                        <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                            <input class="form-check-input" type="radio" name="clrRadio" id="clr3" disabled />
                                                            <label class="form-check-label" for="clr3">
                                                                Graphite
                                                            </label>
                                                        </div>
                                                        <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                            <input class="form-check-input" type="radio" name="clrRadio" id="clr4" disabled />
                                                            <label class="form-check-label" for="clr4">
                                                                Pacific Blue
                                                            </label>
                                                        </div>
                                                        <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                            <input class="form-check-input" type="radio" name="clrRadio" id="clr5" disabled />
                                                            <label class="form-check-label" for="clr5">
                                                                Jet Black
                                                            </label>
                                                        </div>
                                                        <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                            <input class="form-check-input" type="radio" name="clrRadio" id="clr6" disabled />
                                                            <label class="form-check-label" for="clr6">
                                                                Rose Gold
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }

                                            ?>


                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <label class="form-label lbl1">Add Product Quantity</label>
                                            <input class="form-control" type="number" value="<?php echo $product["qty"]; ?>" min="0" id="qty" />
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <hr class="hr-break-1">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lbl1">Cost Per Item</label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost" value="<?php echo $product["price"]; ?>">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lbl1">Approved Payment Methods</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="offset-2 col-2 pm1"></div>
                                                <div class="col-2 pm2"></div>
                                                <div class="col-2 pm3"></div>
                                                <div class="col-2 pm4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr class="hr-break-1">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lbl1">Delivery Costs</label>
                                        </div>

                                        <div class="col-12 col-lg-3 offset-lg-1">
                                            <label class="form-label">Delivery cost within Colombo</label>
                                        </div>

                                        <div class="col-12 col-lg-7">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc" value="<?php echo $product["delivery_free_colombo"]; ?>">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="row mt-lg-4">
                                        <div class="col-12"></div>

                                        <div class="col-12 col-lg-3 offset-lg-1">
                                            <label class="form-label">Delivery cost out of Colombo</label>
                                        </div>

                                        <div class="col-12 col-lg-7">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc" value="<?php echo $product["delivery_free_other"]; ?>">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Product Description</label>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" cols="30" rows="25" id="desc"><?php echo $product["description"]; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Add Product Image</label>
                                    </div>
                                    <div class="col-12">
                                        <?php

                                        $product_image = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "'");
                                        $pid = $product_image->fetch_assoc();

                                        ?>
                                        <img src="<?php echo $pid["code"]; ?>" class="col-5 col-lg-2 ms-2 img-thumbnail" id="prev" />
                                        <img src="resources/addproductimg.svg" class="col-5 col-lg-2 ms-2 img-thumbnail" />
                                        <img src="resources/addproductimg.svg" class="col-5 col-lg-2 ms-2 img-thumbnail" />
                                    </div>

                                    <div class="col-12 col-lg-6 mt-2 ms-4">
                                        <input type="file" class="d-none" accept="img/*" id="imageUploader" />
                                        <label for="imageUploader" class="col-5 col-lg-12 btn btn-warning d-grid" onclick="changeProductImg();">Upload</label>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <hr class="hr-break-1">

                <div class="col-12">
                    <label class="form-label lbl1">Notice...</label>
                    <br />
                    <label class="form-label">We are taking 5% of the product price from every product as a service charge.</label>
                </div>

                <div class="col-12 col-lg-4 offset-lg-4 d-grid mb-2">
                    <button class="btn btn-secondary search-btn mt-1" onclick="updateProduct();">Update Product</button>
                </div>


            </div>

        </div>

        <?php

        require "footer.php";

        ?>




        <script src="script.js"></script>

    </body>

    </html>

<?php

} else {

?>
    <script>
        alert("you have to Sign In or Register First");
        window.location = "index.php";
    </script>

<?php


}

?>