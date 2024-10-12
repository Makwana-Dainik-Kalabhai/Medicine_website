<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("C:/xampp/htdocs/php/medicine_website/database.php");

// Function to send an email
function send_email($name, $email, $html)
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

    $mail->setFrom($email);
    $mail->addAddress("dainikmakwana31@gmail.com");

    $mail->isHTML(true);
    $mail->Subject = "For customer queries";

    $msg = $html;
    $mail->Body = $msg;

    if ($mail->send()) {
        $_SESSION["form_succ"] = "Query Placed Successfully";
    }
}


// Check email exist or not

if (isset($_POST["send"])) {

    $email = $_POST["email"];

    $sel = $conn->prepare("SELECT * FROM `user_login_data`");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $row) {
        if ($email == $row["email"]) {
            $html = "<h1>Cutomer Place a Query</h1>
                    <p><b>Name: </b>" . $_POST["name"] . "</p>
                    <p><b>Email: </b>" . $_POST["email"] . "</p>
                    <p><b>Phone no.: </b>" . $_POST["phone"] . "</p>
                    <p><b>Query/Question: </b>&ensp;" . $_POST["query"] . "</p>";

            send_email($_POST["name"], $email, $html);            

            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/contact_us/contact_us.php");
            return;
        }
        //
        else {
            $_SESSION["form_error"] = "Email ID is not Exist";
            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/contact_us/contact_us.php");
        }
    }
}
