<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style1.css" />
    <link rel="icon" href="resources/logo.svg" />
</head>

<body>

    <div class="col-12" style="background-color: #1c1e1f;">
        <div class="row mt-1 mb-1">

            <div class="col-12 col-lg-4 offset-lg-4 self-align-content-center ">

                <span class="text-lg-start lable1 text-light"><b class="b1">Wellcome</b>

                <?php
                
                session_start();

                if(isset($_SESSION["u"])){
                    $data = $_SESSION["u"];
                    ?>

                    <?php echo $data["fname"];?>|

                    <?php
                }else{

                    ?>

                    <a class="ms-2" href="index.php">Sign In or Register</a>

                    <?php

                }
                
                ?>

                </span> 
                <span class="text-lg-start lable2 ms-2 text-light">Help and Contact</span>
                <?php
                
                if(isset($_SESSION["u"])){
                    ?>
                        <u><span class="text-lg-start lable2 text-primary" onclick="signOut();">| Sign Out</span></u>
                    <?php
                }else{
                    ?>
                        <span></span>
                    <?php
                }
                
                ?>
                

            </div>

            <div class="col-12 col-lg-3 offset-lg-1 align-self-end" style="text-align: center;">

                <div class="row">

                    <div class="col-1 col-lg-3 mt-2">
                        <span class="text-start lable2 text-primary"> <a href="http://localhost/my%20project/home.php">Home</a></span>
                    </div>

                 

                    <div class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1 cart-icon"></div>

                </div>
            </div>

        </div>
    </div>
 <script src="bootstrap.bundle.js"></script>
</body>

</html>