<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signUp Now</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>
</head>

<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/forgot_pass/forgot_pass.css"); ?>
</style>

<script>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/forgot_pass/forgot_pass.js"); ?>
</script>


<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <div id="main_form">
            <div class="left_img">
                <img src="forget_pass.jpg" alt="img not found">
            </div>

            <div id="forgot_pass_form">
                <?php if (isset($_SESSION["form_error"])) { ?>
                    <div id='form_error'><i class='fa-solid fa-circle-info'></i>
                        <?php echo $_SESSION["form_error"]; ?>
                    </div>
                <?php } ?>

                <?php if (isset($_SESSION["form_succ"])) { ?>
                    <div id='form_succ'>
                        <?php echo $_SESSION["form_succ"]; ?>
                    </div>
                <?php } ?>

                <?php if (isset($_SESSION["form_succ"]) && isset($_SESSION["pass_changed"])) { ?>
                    <div id='form_succ'>
                        <?php echo $_SESSION["form_succ"]; ?>
                        <script>
                            setTimeout(() => {
                                location.href = "http://localhost/php/medicine_website/index.php"
                                return;

                            }, 2000);
                        </script>
                    </div>
                <?php } ?>

                <!-- //! IF $_SESSION["set_pass"] is not set then display send otp form -->
                <?php
                if (!isset($_SESSION["set_pass"])) {
                    if (!isset($_SESSION["otp"])) { ?>

                        <span id="heading">Forget Something?</span>
                        <span id="definition">If you are forget your password, write your email here to change with new one.</span>

                        <form action="send_otp.php" method="post" enctype="multipart/form-data">
                            <label for="email">Email:</label>
                            <input type="email" name="email" placeholder="example123@gmail.com" required />

                            <div class="btns">
                                <input type="submit" value="Send OTP" name="send_otp" />
                                <input type="reset" value="Reset" />
                            </div>
                        </form>
                    <?php } ?>

                    <?php
                    if (isset($_SESSION["otp"])) { ?>
                        <span id="heading">Forget Something?</span>
                        <span id="definition">Write down OTP here to change your password with new one.</span>

                        <form action="submit_form.php" method="post" enctype="multipart/form-data">
                            <label for="email">Email:</label>
                            <input type="email" name="email" placeholder="example123@gmail.com" />

                            <label for="otp">OTP:</label>
                            <input type="text" name="otp" placeholder="OTP Here..." required />

                            <div class="btns">
                                <input type="submit" name="submit_form" value="Submit" />
                                <input type="reset" value="Reset" />
                            </div>
                        </form>
                <?php }
                } ?>

                <!-- //! IF $_SESSION["set_pass"] is not set then display update pass form -->
                <?php
                if (isset($_SESSION["set_pass"])) { ?>
                    <span id="heading">OTP Submitted?</span>
                    <span id="definition">If you are submitted the OTP, Now you have chance to change the password</span>

                    <form action="update_pass.php" method="post" enctype="multipart/form-data">
                        <label for="new_pass">New Password:</label>
                        <input type="text" name="new_pass" placeholder="New Password" required />

                        <label for="conf_pass">Confirm Password:</label>
                        <input type="text" name="conf_pass" placeholder="Confirm Password" required />

                        <div class="btns">
                            <input type="submit" name="update_pass" value="Update" />
                            <input type="reset" value="Reset" />
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </main>
    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>

<?php
if (isset($_SESSION["form_error"])) {
    unset($_SESSION["form_error"]);
}
if (isset($_SESSION["form_succ"])) {
    unset($_SESSION["form_succ"]);
}
?>