<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Now</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>
</head>

<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/form/form.css"); ?>
</style>

<script>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/form/form.js"); ?>
</script>

<?php if (!isset($_SESSION["max_try"])) {
    $_SESSION["max_try"] = 0;
}
if ($_SESSION["time"] <= time()) {
    unset($_SESSION["time"]);
} ?>

<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <!-- Login Form -->
        <div class="regi_form">
            <div class="left_img">
                <img src="http://localhost/php/medicine_website/user_panel/form/image.avif" alt="">
            </div>

            <?php if (!isset($_SESSION["admin_user"])) { ?>
                <div id="login_form">

                    <?php if (isset($_SESSION["form_error"])) { ?>
                        <div id='form_error'><i class='fa-solid fa-circle-info'></i>
                            <?php echo $_SESSION["form_error"]; ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($_SESSION["form_succ"])) {
                    ?>
                        <div id='form_succ'>
                            <?php echo $_SESSION["form_succ"];
                            ?>
                            <script>
                                setTimeout(() => {
                                    location.href = "http://localhost/php/medicine_website/index.php"
                                    return;

                                }, 2000);
                            </script>
                        </div>
                    <?php }
                    ?>

                    <span class="heading">Login Now</span>
                    <span class="description">Login now to access your orders, book appoitment, get heath tips and for many more</span>

                    <form action="verify.php" method="post" enctype="multipart/form-data">
                        <label for="login_email">Email:</label>
                        <input type="email" name="login_email" placeholder="Enter your Email ID" required />

                        <label for="login_pass">Password:</label>
                        <div class="pass_div">
                            <input type="password" name="login_pass" class="pass" placeholder="Enter your Password" required />
                            <i class="fa-regular fa-eye"></i><i class="fa-regular fa-eye-slash"></i>
                        </div>
                        <a href="http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php" id="forget_pass_link">Forget Password?</a>

                        <div class="btns">
                            <input type="submit" value="Login" name="login_submit" />
                            <input type="reset" value="Reset" />
                            <a href="http://localhost/php/medicine_website/user_panel/form/sign_form.php">Create an Account</a>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
    </main>
    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>

<?php
if (isset($_SESSION["set_pass"])) {
    unset($_SESSION["set_pass"]);
}
if (isset($_SESSION["pass_changed"])) {
    unset($_SESSION["pass_changed"]);
}
if (isset($_SESSION["otp"])) {
    unset($_SESSION["otp"]);
}
if (isset($_SESSION["form_error"])) {
    unset($_SESSION["form_error"]);
}
if (isset($_SESSION["form_succ"])) {
    unset($_SESSION["form_succ"]);
}
?>