<?php

session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>MI SHOP | Admin Panel</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style1.css" />
    </head>

    <body class="admin1">


        <?php
        require "header.php";
        ?>

        <div class="container-fluid">
            <div class="row" id="mainrow">

                <div class="col-12 col-lg-2">
                    <div class="row">

                        <div class="align-items-start bg-dark col-12 mt-1">
                            <div class="row g-2 text-center">

                                <div class="col-12 mt-5">
                                    <h4 class="text-light fw-bold"><?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"] ?></h4>
                                    <hr class="border border-1 border-dark">
                                </div>

                                <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">
                                    <nav class="nav flex-column">
                                        <a class="nav-link active bg-secondary fs-5" aria-current="page" href="#">DASHBOARD</a>
                                        <a class="nav-link fs-5 text-dark" href="http://localhost/my%20project/manageusers.php">Manage Users</a>
                                        <a class="nav-link fs-5 text-dark" href="http://localhost/my%20project/manageproducts.php?page=2">Manage Products</a>
                                    </nav>
                                </div>

                                <div class="col-12 mt-3">
                                    <hr class="border border-1 border-white" />
                                    <h4 class="text-white">Selling History</h4>
                                    <hr class="border border-1 border-white" />
                                </div>

                                <div class="col-12 mt-3 d-grid">
                                    <h5 class="text-white fw-bold">From Date :</h5>
                                    <input type="date" class="form-control" />
                                    <h5 class="text-white mt-2 fw-bold">To Date :</h5>
                                    <input type="date" class="form-control" />
                                    <a href="#" class="btn btn-secondary fw-bold mt-2">View Sellings</a>
                                    <hr class="border border-1 border-white" />

                                    <hr>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-lg-10">
                    <div class="row">

                        <div class="col-12 text-dark fw-bold mb-3 mt-2">
                            <h2 class="fw-bold fs-1 text-center mt-4">MI SHOP DASHBOARD</h2>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-dark" />
                        </div>

                        <div class="col-12">
                            <div class="row g-1 mt-3">

                                <div class="col-6 col-lg-6 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 bg-secondary  text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Daily earnings</span>
                                            <br />
                                            <?php

                                            $today = date("Y-m-d");
                                            $this_month = date("m");
                                            $this_year = date("y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $d = "0";
                                            $e = "0";

                                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                $e = $e + $invoice_data["qty"];

                                                $f = $invoice_data["date"];
                                                $split_date = explode(" ", $f);
                                                $pdate = $split_date[0];

                                                if ($pdate == $today) {
                                                    $a = $a + $invoice_data["total"];
                                                    $c = $c + $invoice_data["qty"];
                                                }

                                                $split_result = explode("-", $pdate);
                                                $pyear = $split_result[0];
                                                $pmonth = $split_result[1];

                                                if ($pyear == $this_year) {
                                                    if ($pmonth == $this_month) {
                                                        $b = $b + $invoice_data["total"];
                                                        $d = $d = $invoice_data["qty"];
                                                    }
                                                }
                                            }

                                            ?>
                                            <span class="fs-5">Rs. 100000.00</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-6 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 bg-white  text-black text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly earnings</span>
                                            <br />
                                            <span class="fs-5">Rs. 100000.00</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 bg-warning  text-black text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Selling</span>
                                            <br />
                                            <span class="fs-5">1 Item</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 bg-primary  text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Selling</span>
                                            <br />
                                            <span class="fs-5">10 Itams</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 bg-success text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Selling</span>
                                            <br />
                                            <span class="fs-5">Rs. 100000.00</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1 mx-auto">
                                    <div class="row g-1">

                                        <div class="col-12 bg-danger  text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Engagements</span>
                                            <br />
                                            <span class="fs-5">100 Requests</span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-12 bg-dark">
                            <div class="row">

                                <div class="col-12 col-lg-6 text-center mt-3 mb-3">
                                    <label class="form-label fs-4 fw-bold text-white">Total Active Time</label>
                                </div>

                                <div class="col-12 col-lg-6 text-center mt-3 mb-3">
                                    <label class="form-label fs-4 fw-bold text-white">00.00.00</label>
                                </div>

                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                            <div class="row g-1">

                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold">Mosly sold Item</label>
                                </div>

                                <div class="col-12 text-center">
                                    <img src="resources/Motar_and_Pastle/Granite_mortar.jpeg" class="img-fluid rounded-top" style="height: 250px;" />
                                    <hr />
                                </div>

                                <div class="col-12 text-center">
                                    <span class="fs-5 fw-bold">AGranite mortar and pestle</span> <br />
                                    <span class="fs-6">10 Items</span> <br />
                                    <span class="fs-6">Rs.4000.00</span>
                                </div>

                                <div class="col-12 mb-2">
                                    <div class="first_place"></div>
                                </div>

                            </div>
                        </div>

                        <div class="offset-1 offset-lg-2 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                            <div class="row g-1">

                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold">Most Famous Seller</label>
                                </div>

                                <div class="col-12 text-center">
                                    <img src="resources/profiles/user.png" class="img-fluid rounded-top" style="height: 250px;" />
                                    <hr />
                                </div>

                                <div class="col-12 text-center">
                                    <span class="fs-5 fw-bold">Gavrawa Thilakshana</span> <br />
                                    <span class="fs-6">gavrawavanniarachchi@gmail.com</span> <br />
                                    <span class="fs-6">0717102743</span>
                                </div>

                                <div class="col-12 mb-2">
                                    <div class="first_place"></div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        <script src="script.js"></script>
    </body>

    </html>
<?php
} else {

?>

    <script>
        alert("Please SignIn first");
        window.location = "adminsignin.php";
    </script>

<?php

}

?>