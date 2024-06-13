<?php

require "connection.php";

$search_text = $_POST["s"];
$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$color = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["pt"];


$query = "SELECT * FROM product ";

$status = 0;

if (!empty($search_text)) {

    $query .= " WHERE `title` LIKE '%" . $search_text . "%'";
    $status = 1;
}

if ($category != "0" && $status == "0") {

    $query .= " WHERE `category`= '" . $category . "' ";
    $status = 1;
} else if ($category != "0" && $status == 1) {

    $query .= " AND `category`= '" . $category . "' ";
    $status = 1;
}

$status2 = 0;

if ($brand != "0" || $model != "0") {

    $modelHasBrandId= Database::search("SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $brand . "'
    OR `model_id`= '" . $model . "' ");

    $n = $modelHasBrandId->num_rows;

    if ($n == "1") {
        $f = $modelHasBrandId->fetch_assoc();
        $i = $f["id"];
        $status2 = 1;
    } else {
        $status2 = 0;
    }
} else {
    $status2 = 0;
}

if ($category == "0" && $status2 == "1" && empty($search_text)) {
    $query .= " WHERE `model_has_brand_id`= '" . $i . "' ";
    $status = 1;
} else if ($status2 == "1") {
    $query .= " AND `model_has_brand_id`= '" . $i . "' ";
    $status = 1;
}

if ($condition != "0" && $status == "0") {

    $query .= " WHERE `condition_id`= '" . $condition . "' ";
    $status = 1;
} else if ($condition != "0" && $status == 1) {

    $query .= " AND `condition_id`= '" . $condition . "' ";
    $status = 1;
}

if ($color != "0" && $status == "0") {

    $query .= " WHERE `colour_id`= '" . $color . "' ";
    $status = 1;
} else if ($color != "0" && $status == "1") {

    $query .= " AND `colour_id`= '" . $color . "' ";
    $status = 1;
}

if ($status == "0") {

    if (!empty($price_from) && empty($price_to)) {

        $query .= " WHERE `price` >= '" . $price_from . "' ";
        $status = 1;
    } else if (empty($price_from) && !empty($price_to)) {

        $query .= " WHERE `price` <= '" . $price_to . "' ";
        $status = 1;
    } else if (!empty($price_from) && !empty($price_to)) {

        $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ";
        $status = 1;
    }
} else if ($status == "1") {

    if (!empty($price_from) && empty($price_to)) {

        $query .= " AND `price` >= '" . $price_from . "' ";
        $status = 1;
    } else if (empty($price_from) && !empty($price_to)) {

        $query .= " AND `price` <= '" . $price_to . "' ";
        $status = 1;
    } else if (!empty($price_from) && !empty($price_to)) {

        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ";
        $status = 1;
    }
}

$query1 = $query;
// echo $query1;

?>

<div class="row">
    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">

            <?php

            if ("0" != ($_POST["page"])) {

                $pageno = $_POST["page"];
            } else {

                $pageno = 1;
            }


            $products = Database::search($query);
            $nProduct = $products->num_rows; //total results
            $userProducts = $products->fetch_assoc();

            $results_per_page = 6;
            $num_of_pages = ceil($nProduct / $results_per_page);

            $viewed_results_count = ((int)$pageno - 1) * $results_per_page;
            $query1 .= "LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . " ";
            $selectedrs = Database::search($query1);

            $srn = $selectedrs->num_rows;


            while ($ps = $selectedrs->fetch_assoc()) {

                // for ($x = 0; $x < $srn; $x++) {}

            ?>

                <div class="card mb-3 mt-3 col-12 col-lg-6">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">

                            <?php

                            $pimgrs = Database::search("SELECT * FROM images WHERE `product_id` = '" . $ps["id"] . "' ");
                            $presult = $pimgrs->fetch_assoc();

                            ?>

                            <img src="<?php echo $presult["code"]; ?>" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">

                                <h5 class="card-title "><?php echo $ps["title"]; ?></h5>
                                <span class="card-text text-primary ">Rs. <?php echo $ps["price"]; ?> .00</span>
                                <br />
                                <span class="card-text text-success  "><?php echo $ps["qty"]; ?> item lest.</span>

                                <div class="row">
                                    <div class="col-12">

                                        <div class="row g-1">
                                            <div class="col-12 d-grid">
                                                <a href="#" class="btn btn-warning fs">Buy Now</a>
                                            </div>
                                            <div class="col-12 d-grid">
                                                <a href="#" class="btn btn-dark fs">Add Cart</a>
                                            </div>
                                            <div class="col-12 d-grid">
                                                <a href="#" class="btn btn-light fs"><i class="bi bi-heart-fill fs-4"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            <?php

            }

            ?>

        </div>

    </div>

    <div class="offset-0 offset-lg-4 col-12 col-lg-4">
        <div class="row">
            <div class="pagination">
                <a <?php

                    if ($pageno <= 1) {

                        echo "#";
                    } else {

                    ?> onclick="advancedsearch('<?php echo ($pageno - 1); ?>');" <?php

                                                                                }

                                                                                    ?>>&laquo;</a>

                <?php

                for ($page = 1; $page <= $num_of_pages; $page++) {

                    if ($page == $pageno) {

                ?>

                        <a onclick="advancedsearch('<?php echo $page; ?>');" class="active"><?php echo $page; ?></a>

                    <?php

                    } else {

                    ?>

                        <a onclick="advancedsearch('<?php echo $page; ?>');"><?php echo $page; ?></a>

                <?php

                    }
                }

                ?>

                <!-- <a href="#">1</a>
                <a href="#" class="active">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a> -->


                <a <?php

                    if ($pageno >= $num_of_pages) {

                        echo "#";
                    } else {

                    ?> onclick="advancedsearch('<?php echo ($pageno + 1); ?>');" <?php

                                                                                }

                                                                                    ?>>&raquo;</a>
            </div>
        </div>
    </div>

</div>

<?php



?>