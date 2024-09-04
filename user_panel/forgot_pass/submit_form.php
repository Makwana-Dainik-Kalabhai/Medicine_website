<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_POST["submit_form"]) && isset($_POST["otp"])) {

    $otp = $_POST["otp"];

    if ($_SESSION["otp"] == $otp) {

        if (isset($_SESSION["user_email"])) {

            // Check OTP Limit Time for the User
            $otp_limit = $conn->prepare("SELECT otp_limit FROM `user_login_data` WHERE email='" . $_SESSION["user_email"] . "'");
            $otp_limit->execute();
            $otp_limit = $otp_limit->fetchAll();


            foreach ($otp_limit as $row) {
                if ((time() - $row["otp_limit"]) > 600) {
                    $_SESSION["form_error"] = "Your OTP is expired";

                    unset($_SESSION["otp"]);
                    unset($_SESSION["user_email"]);

                    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php");

                    //
                } else {
                    $_SESSION["set_pass"] = true;

                    unset($_SESSION["otp"]);
                    unset($_SESSION["form_error"]);

                    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php");
                }
            }
        }



        if (isset($_SESSION["admin_email"])) {

            // Check OTP Limit Time for the
            $otp_limit = $conn->prepare("SELECT otp_limit FROM `admin_login_data` WHERE email='" . $_SESSION["admin_email"] . "'");
            $otp_limit->execute();
            $otp_limit = $otp_limit->fetchAll();


            foreach ($otp_limit as $row) {
                if ((time() - $row["otp_limit"]) > 600) {
                    $_SESSION["form_error"] = "Your OTP is expired";

                    unset($_SESSION["otp"]);
                    unset($_SESSION["admin_email"]);

                    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php");

                    //
                } else {
                    $_SESSION["set_pass"] = true;
                    unset($_SESSION["otp"]);
                    unset($_SESSION["form_error"]);

                    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php");
                }
            }
        }


        //
    } else {
        $_SESSION["form_error"] = "Invalid OTP";

        header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php");
    }
}
