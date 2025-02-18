<?php session_start();
if (!isset($_SESSION["email"])) { ?>
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
                                    history.go(-2);
                                    return;

                                }, 2000);
                            </script>
                        </div>
                    <?php }
                    ?>


                    <span class="heading">Signup Now</span>

                    <form action="verify.php" method="post" enctype="multipart/form-data">
                        <label for="sign_name">Name <b style="color: red;font-weight: 500;">*</b></label>
                        <input type="text" name="sign_name" pattern="[A-Za-z ]*" placeholder="Enter Name" required />

                        <label for="sign_email">Email <b style="color: red;font-weight: 500;">*</b></label>
                        <input type="email" name="sign_email" placeholder="Enter Email ID" required />

                        <label for="sign_pass">Password <b style="color: red;font-weight: 500;">*</b></label>
                        <div class="pass_div">
                            <input type="password" name="sign_pass" class="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Enter Password" required />
                            <i class="fa-regular fa-eye"></i><i class="fa-regular fa-eye-slash"></i>
                        </div>
                        <span id="pass_des">Minimum 8 digits, 1 Uppercase, 1 Lowercase letter</span>

                        <label for="sign_phone">Phone <b style="color: red;font-weight: 500;">*</b></label>
                        <input type="number" name="sign_phone" pattern="[0-9].{10,10}" minlength="10" maxlength="10" placeholder="Enter Phone no." title="Please! Enter 10 digit number" required />

                        <div class="row">
                            <div class="col-md-6">
                                <label for="house_no">House No. <b style="color: red;font-weight: 500;">*</b></label>
                                <input type="text" name="house_no" placeholder="House No." required />
                            </div>
                            <div class="col-md-6">
                                <label for="street">Street <b style="color: red;font-weight: 500;">*</b></label>
                                <input type="text" name="street" placeholder="Street" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="suite">Apartment Suite <b style="color: red;font-weight: 500;">*</b></label>
                                <input type="text" name="suite" placeholder="Apartment Suite" required />
                            </div>
                            <div class="col-md-6">
                                <label for="pincode">Pincode <b style="color: red;font-weight: 500;">*</b></label>
                                <input type="number" pattern="[0-9].{6,6}" minlength="6" maxlength="6" name="pincode" placeholder="Pincode" title="Please! Enter 6 digit pincode" required />
                            </div>
                        </div>

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
} else { ?>
    <script>
        window.history.go(-2);
    </script>
<?php } ?>