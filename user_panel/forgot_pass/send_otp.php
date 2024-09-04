<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("C:/xampp/htdocs/php/medicine_website/database.php");


// Function to send an email
function send_email($name, $email)
{

    require "C:/xampp/htdocs/php/medicine_website/user_panel/forgot_pass/phpmailer/src/Exception.php";
    require "C:/xampp/htdocs/php/medicine_website/user_panel/forgot_pass/phpmailer/src/PHPMailer.php";
    require "C:/xampp/htdocs/php/medicine_website/user_panel/forgot_pass/phpmailer/src/SMTP.php";

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "dainikmakwana31@gmail.com";
    $mail->Password = "kjhc tkbb hzcn ciep";
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("dainikmakwana31@gmail.com");
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "For One Time Password(OTP)";
    $otp = mt_rand(100000, 999999);


    $msg = "Hey! " . $name . ". Your One Time Password(OTP) is $otp. If you want to reset password, then paste it on forget password form.";


    $mail->Body = $msg;

    if ($mail->send()) {
        $_SESSION["otp"] = $otp;
    }
}


// Check email exist or not

if (isset($_POST["send_otp"])) {


    $_SESSION["forget_pass_email"] = $email = $_POST["email"];

    $sel_user = $conn->prepare("SELECT * FROM `user_login_data`");
    $sel_user->execute();
    $sel_user = $sel_user->fetchAll();

    foreach ($sel_user as $row_user) {
        if ($email == $row_user["email"]) {
            $_SESSION["user_email"] = $row_user["email"];

            send_email($row_user["name"], $email);

            $_SESSION["form_succ"] = "OTP send successfully";

            $curr_time = time();

            $otp_send_time = $conn->prepare("UPDATE `user_login_data` SET otp_limit='$curr_time' WHERE email='$email'");
            $otp_send_time->execute();

            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php");
            return;
        }
        //
        else {
            $_SESSION["form_error"] = "Email ID is not Exist";
            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php");
        }
    }

    $sel_admin = $conn->prepare("SELECT * FROM `admin_login_data`");
    $sel_admin->execute();
    $sel_admin = $sel_admin->fetchAll();

    foreach ($sel_admin as $row_admin) {
        if ($email == $row_admin["email"]) {
            $_SESSION["admin_email"] = $row_admin["email"];

            send_email($row_admin["name"], $email);

            $_SESSION["form_succ"] = "OTP send successfully";

            $curr_time = time();

            $otp_send_time = $conn->prepare("UPDATE `admin_login_data` SET otp_limit='$curr_time' WHERE email='$email'");
            $otp_send_time->execute();

            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php");
            return;
        }
        //
        else {
            $_SESSION["form_error"] = "Email ID is not Exist";
            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php");
        }
    }
}
