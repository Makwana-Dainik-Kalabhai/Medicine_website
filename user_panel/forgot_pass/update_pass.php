<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_POST["update_pass"])) {

    $new_pass = $_POST["new_pass"];
    $conf_pass = $_POST["conf_pass"];

    if ($new_pass != $conf_pass) {
        $_SESSION["form_error"] = "New Password & Confirm Password is not same.";
        
        header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php");
    }
    //

    else {
        // Get user email
        if (isset($_SESSION["user_email"])) {

            $update_user = $conn->prepare("UPDATE `user_login_data` SET pass='$new_pass' WHERE email='".$_SESSION["user_email"]."'");
            $update_user->execute();

            $_SESSION["form_succ"] = "Password updated successfully";
            $_SESSION["pass_changed"] = true;

            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php");
        }

        // Get Admin email
        if (isset($_SESSION["admin_email"])) {

            $update_admin = $conn->prepare("UPDATE `admin_login_data` SET pass='$new_pass' WHERE email='".$_SESSION["admin_email"]."'");
            $update_admin->execute();

            $_SESSION["form_succ"] = "Password updated successfully";
            $_SESSION["pass_changed"] = true;

            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php");
        }
    }
}
