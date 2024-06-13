<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $id = $_GET["id"];
    $mail = $_SESSION["u"]["email"];

    $watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$id."'
    AND `user_email`='".$mail."'");

    if($watchlistrs->num_rows == 1){

        $watchresult = $watchlistrs->fetch_assoc();
        
        Database::iud("DELETE FROM `watchlist` WHERE `id`='".$watchresult["id"]."'");
        echo "Success2";

    }else{
        Database::iud("INSERT INTO `watchlist` (`product_id`,`user_email`)VALUES('".$id."','".$mail."')");
        echo "Success";
    }

}else{
    echo "You Have To Sign In First";
}



?>