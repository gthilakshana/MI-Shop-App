<?php

require "connection.php";

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["e"])){

    $email = $_POST["e"];

    if(empty($email)){
        echo "Please enter your Email Address.";
    }else{

        $adminrs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
        $an = $adminrs->num_rows;

        if($an == 1){

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gavrawavanniarachchi@gmail.com'; 
            $mail->Password = 'qoooqtaodpmoimuc'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('gavrawavanniarachchi@gmail.com', 'MI SHOP'); 
            $mail->addReplyTo('gavrawavanniarachchi@gmail.com', 'MI SHOP');
            $mail->addAddress($email); 
            $mail->isHTML(true);
            $mail->Subject = 'MI SHOP Admin Verification Code.'; 
            $bodyContent = '<h1 style="color:red";><b>Your Verification Code Is :'.$code.'<b></h1>'; 
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'success';
            }

        }else{
            echo "You are not a valid user.";
        }

    }
}



?>