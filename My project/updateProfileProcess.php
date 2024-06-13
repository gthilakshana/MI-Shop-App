<?php

    require "connection.php";

    session_start();

    if(isset($_SESSION["u"])){

        $fname = $_POST["f"];
        $lname = $_POST["l"];
        $mobile = $_POST["m"];
        $addline1 = $_POST["a1"];
        $addline2 = $_POST["a2"];
        $city = $_POST["c"];
        $img = $_FILES["i"];

        if(isset($img)){

            $allowed_image_extention = array("image/jpg","image/jpeg","image/png","image/svg");
            $fileex = $img["type"];
            // echo $fileex;

            if(!in_array($fileex,$allowed_image_extention)){

                echo "Please Select a Valid image.";

            }else{

                $newImageextention;
                if($fileex == "image/jpg"){
                    $newImageextention = ".jpg";
                }else if($fileex == "image/jpeg"){
                    $newImageextention = ".jpeg";
                }else if($fileex == "image/png"){
                    $newImageextention = ".png";
                }else if($fileex == "image/svg"){
                    $newImageextention = ".svg";
                }

                $file_name = "resources//profiles//".uniqid().$newImageextention;
                // echo $file_name;

                move_uploaded_file($img["tmp_name"],$file_name);

                $profilers = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='".$_SESSION["u"]["email"]."'");
                $in = $profilers->num_rows;

                if($in == 1){

                    Database::iud("UPDATE `profile_img` SET `code`='".$file_name."' WHERE `user_email`='".$_SESSION["u"]["email"]."'");

                    echo "Profile image Updated successfully";

                }else{

                    Database::iud("INSERT INTO `profile_img`(`code`,`user_email`) VALUES ('".$file_name."','".$_SESSION["u"]["email"]."')");

                    echo "New profile image saved successfully";

                }

            }

        }else{

            echo "please Selct an Image.";

        }

        Database::iud("UPDATE `user` SET `fname`='".$fname."',`lname`='".$lname."',`mobile`='".$mobile."' WHERE `email`='".$_SESSION["u"]["email"]."'");

        echo "user has been Updated.";

        $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$_SESSION["u"]["email"]."'");
        $nrs = $addressrs->num_rows;

        if($nrs == 1){ 

            Database::iud("UPDATE `user_has_addres` SET `line1`='".$addline1."',`line2`='".$addline2."',`city_id`='".$city."' WHERE `user_email`='".$_SESSION["u"]["email"]."'");

            echo "Address Update Successfull";

        }else{  // update karala nathi kenek nm details save karanawa

            Database::iud("INSERT INTO `user_has_addres`(`user_email`,`line1`,`line2`,`city_id`) VALUES ('".$_SESSION["u"]["email"]."','".$addline1."','".$addline2."','".$city."')");

            echo "new Address Added Successfully.";

        }

    }else{

        echo "error";

    }
    
?>