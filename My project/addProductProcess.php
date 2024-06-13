<?php

session_start();
require "connection.php";

$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["co"];
$color = $_POST["col"];
$qty = $_POST["qty"];
$price = $_POST["p"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$description = $_POST["desc"];
$imagefile = $_FILES["img"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d -> setTimezone($tz);
$date = $d -> format("Y-m-d H:i:s");

$status = 1;
$usermail = $_SESSION["u"]["email"];

if($category == "0"){
    echo "Please select a category";
}else if($brand == "0"){
    echo "Please select a brand.";
}else if($model == "0"){
    echo "Please select a model.";
}else if(empty($title)){
    echo "Please add a title to your product.";
}else if(strlen($title) > 100){
    echo "Please enter a title contains 100 characters or lower.";
}else if(empty($qty)){
    echo "quantity field must not be empty.";
}else if($qty == "0" || $qty == "e" || $qty < 0){
    echo "please enter a valid quantity.";
}else if(empty($price)){
    echo "Please enter a price to your product.";
}else if(is_int($price)){
    echo "please enetr a valid price";
}else if(empty($dwc)){
    echo "Please enter the delivery cost inside Colombo.";
}else if(is_int($dwc)){
    echo "please enetr a valid price for delivery inside Colombo";
}else if(empty($doc)){
    echo "Please enter the delivery cost outside Colombo.";
}else if(is_int($doc)){
    echo "please enetr a valid price for delivery outside Colombo";
}else if(empty($description)){
    echo "Please enter a description to your product.";
}else{

    $modelHasBrand = Database::search("SELECT `id` FROM `model_has_brand` WHERE `brand_id`='".$brand."' AND `model_id`='".$model."'");

    if($modelHasBrand -> num_rows == 0){
        echo "this product does not exists.";
    }else{

        $f = $modelHasBrand->fetch_assoc();
        $modelHasBrandId = $f["id"];

        Database::iud("INSERT INTO `product`(`category`,`model_has_brand_id`,`colour_id`,`price`,`qty`,`description`,`title`,`condition_id`,`status_id`,`user_email`,`date_time_added`,`delivery_free_colombo`,`delivery_free_other`)
        VALUES ('".$category."','".$modelHasBrandId."','".$color."','".$price."','".$qty."','".$description."','".$title."','".$condition."','".$status."','".$usermail."','".$date."','".$dwc."','".$doc."')");

        // echo "Product added successfully.";

        $last_id = Database::$connection->insert_id;

        $allowed_image_extention = array("image/jpg","image/jpeg","image/png","image/svg");

        if(isset($_FILES["img"])){
            $image = $_FILES["img"];
        }

        if(isset($image)){

            $file_extention = $image["type"];

          

            if(in_array($file_extention,$allowed_image_extention)){

                    $newImageextention;
                if($file_extention == "image/jpg"){
                    $newImageextention = ".jpg";
                }else if($file_extention == "image/jpg.jpeg"){
                    $newImageextention = ".jpg.jpeg";
                }else if($file_extention == "image/jpeg"){
                    $newImageextention = ".jpeg"; 
                }else if($file_extention == "image/png"){
                    $newImageextention = ".png";
                }else if($file_extention == "image/svg"){
                    $newImageextention = ".svg";
                }

                $fileName = "resources//Category//".uniqid().$image["name"].$newImageextention;
                move_uploaded_file($image["tmp_name"],$fileName);
                
                Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES ('".$fileName."','".$last_id."')");

            }else{
                echo "Please select a valid image.";
            }

        }else{
            echo "Please Select an Image";
        }
    }

    echo "success";
}
