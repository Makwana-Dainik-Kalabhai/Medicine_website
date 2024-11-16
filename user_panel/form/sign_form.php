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
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/form/form.css"); ?>
</style>

<script>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/form/form.js"); ?>
</script>


<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <!-- signUp Form -->
        <div class="regi_form">
            <div class="left_img">
                <img src="http://localhost/php/medicine_website/user_panel/form/image.avif" alt="">
            </div>

            <div id="sign_form">
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


                <span class="heading">Signup Now</span>

                <form action="verify.php" method="post" enctype="multipart/form-data">
                    <label for="sign_name">Name:</label>
                    <input type="text" name="sign_name" pattern="[A-Za-z ]*" placeholder="Enter Name" required />

                    <label for="sign_email">Email:</label>
                    <input type="email" name="sign_email" placeholder="Enter Email ID" required />
                    
                    <label for="sign_pass">Password:</label>
                    <div class="pass_div">
                        <input type="password" name="sign_pass" class="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Enter Password" required />
                        <i class="fa-regular fa-eye"></i><i class="fa-regular fa-eye-slash"></i>
                    </div>
                    <span id="pass_des">Minimum 8 digits, 1 Uppercase, 1 Lowercase letter</span>
                    
                    <label for="sign_phone">Phone:</label>
                    <input type="number" name="sign_phone" maxlength="10" placeholder="Enter Phone no." required />

                    <label for="sign_address">Address:</label>
                    <textarea name="sign_address" placeholder="Enter Address"></textarea>

                    <div class="btns">
                        <input type="submit" value="signUp" name="sign_submit" />
                        <input type="reset" value="Reset" />
                        <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php">Already Signup?</a>
                    </div>
                </form>
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