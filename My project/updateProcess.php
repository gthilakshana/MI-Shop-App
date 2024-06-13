<?php
session_start();
require "connection.php";

$t = $_POST["t"];
$qty = $_POST["qty"];
$c = $_POST["c"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];
$i = $_FILES["i"];

$productid = $_SESSION["p"]["id"];

Database::iud("UPDATE `product` SET `title`='".$t."',`qty`='".$qty."',`price`='".$c."',
`delivery_free_colombo`='".$dwc."',`delivery_free_other`='".$doc."',`description`='".$desc."'
WHERE `id`='".$productid."'");

echo "Product Update Successfully.";

$last_id = Database::$connection->insert_id;

$allowed_image_extentions = array("image/jpeg","image/jpg","image/png","image/svg");

if(isset($i)){
    $images = $i;

    $file_extention = $images["type"];

    if(!in_array($file_extention,$allowed_image_extentions)){
        echo "Please Select An Valid Image File.";
    }else{

        $fileName = "resources//Category//".uniqid().$images["name"];
        move_uploaded_file($images["tmp_name"],$fileName);

        Database::iud("UPDATE `images` SET `code`='".$fileName."' WHERE `product_id`='".$productid."'");

        echo "Product Image Uploaded Success";

    }

}else{
    echo "Please Select An Image File.";
}


?>