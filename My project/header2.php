<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="col-12" style="background-color: #232b2b">
        <div class="row mt-1 mb-1">

            <div class="col-12 col-lg-3 offset-lg-1 align-self-start">

                <span class="text-lg-start lable1"><b>Wellcome</b>

                <?php
                
                session_start();

                if(isset($_SESSION["u"])){
                    $data = $_SESSION["u"];
                    ?>

                    <?php echo $data["fname"];?>|

                    <?php
                }else{

                    ?>

                    <a href="index.php">Sign In or Register</a>

                    <?php

                }
                
                ?>

                </span> 
                <span class="text-lg-start lable2">Help and Contact</span>
                <?php
                
                if(isset($_SESSION["u"])){
                    ?>
                        <u><span class="text-lg-start lable2" onclick="signOut();">| Sign Out</span></u>
                    <?php
                }else{
                    ?>
                        <span></span>
                    <?php
                }
                
                ?>
                

            </div>

           
        </div>
    </div>
 <script src="bootstrap.bundle.js"></script>
</body>

</html>