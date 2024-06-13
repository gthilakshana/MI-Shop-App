<?php

require "connection.php";

$pid = $_GET["id"];

$watchrs = Database::search("SELECT * FROM `watchlist` WHERE `id`='".$pid."'");
$watch_numb = $watchrs->num_rows;

if($watch_numb == 0){
    echo "Sorry for the inconvinient.....";
}else{
    $watchrow = $watchrs->fetch_assoc();

    $id = $watchrow["product_id"];
    $mail = $watchrow["user_email"];

    Database::iud("INSERT INTO `recent` (`product_id`,`user_email`) VALUES ('".$id."','".$mail."')");
    //Insert product data to the recent table

    Database::iud("DELETE FROM `watchlist` WHERE `id`='".$pid."'");

    echo "Success";
}

?>