<?php session_start();
if (!isset($_SESSION["email"])) { ?>
    <script>
        window.history.go(-2);
    </script>
<?php } ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signUp Now</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>
</head>

<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/profile/profile.css"); ?>
</style>

<script>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/profile/profile.js"); ?>
</script>

<?php include("C:/xampp/htdocs/php/medicine_website/database.php"); ?>

<body>

    <main>
        <?php
        $select = $conn->prepare("SELECT * FROM `user_login_data` WHERE email='" . $_SESSION["email"] . "'");
        $select->execute();
        $select = $select->fetchAll();

        foreach ($select as $row) { ?>

            <div id="main_div">
                <div id="page1">
                    <div id="heading">
                        <h1>My Account</h1>
                        <div id="right_img">
                            <?php if ($row["profile_img"] != null) { ?>
                                <img src="http://localhost/php/medicine_website/user_panel/profile/profile_imgs/<?php echo $row["profile_img"]; ?>" alt="">
                            <?php } else { ?>
                                <img src="user.png" alt="">
                            <?php } ?>
                            <span id="name"><?php echo $row["name"]; ?></span>
                        </div>
                    </div>
                    <div id="description">
                        <h1>Hello! <?php echo $row["name"]; ?></h1>
                        <span>Here is your Account info.You can edit your information that you want.</span>
                        <button class="edit_btn">Edit Profile</button>
                    </div>
                </div>


                <div id="page2">
                    <div id="left_div">
                        <?php if ($row["profile_img"] == null) { ?>
                            <div id="profile_img">
                                <img src="http://localhost/php/medicine_website/user_panel/profile/user.png" alt="">
                                <span id="name"><?php echo $row["name"]; ?></span>
                                <span id="email"><?php echo $row["email"]; ?></span>
                            </div>
                        <?php }
                        //
                        else { ?>
                            <div id="profile_img">
                                <img src="http://localhost/php/medicine_website/user_panel/profile/profile_imgs/<?php echo $row["profile_img"]; ?>" alt="">
                                <span id="name"><?php echo $row["name"]; ?></span>
                                <span id="email"><?php echo $row["email"]; ?></span>
                            </div>
                        <?php } ?>
                    </div>
                    <div id="right_div">

                        <!-- //! Show Profile Form -->
                        <div id="show_profile">
                            <h1>My Profile</h1>
                            <div class="container">
                                <div class="row mb-4">
                                    <div class="col-md-8">
                                        <label>Name:</label>
                                        <p><?php echo $row["name"]; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Phone:</label>
                                        <p>+91 <?php if ($row["phone"] != 0) {
                                                    echo $row["phone"];
                                                } ?></p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-8">
                                        <label>Gender:</label>
                                        <p><?php echo $row["gender"]; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Age:</label>
                                        <p><?php if ($row["age"] != 0) {
                                                echo $row["age"] . " years";
                                            } ?></p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-8">
                                        <label>Email ID:</label>
                                        <p><?php echo $row["email"]; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Password:</label>
                                        <p><?php echo $row["pass"]; ?></p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-8">
                                        <label>Street:</label>
                                        <p><?php if (isset(unserialize($row["address"])["street"])) echo unserialize($row["address"])["street"]; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>House no.:</label>
                                        <p><?php if (isset(unserialize($row["address"])["house_no"])) echo unserialize($row["address"])["house_no"]; ?></p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-8">
                                        <label>Apartment suite(optional):</label>
                                        <p><?php if (isset(unserialize($row["address"])["suite"])) echo unserialize($row["address"])["suite"]; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Pincode:</label>
                                        <p><?php if (isset(unserialize($row["address"])["pincode"])) echo unserialize($row["address"])["pincode"]; ?></p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-8">
                                        <label>City:</label>
                                        <p><?php if (isset(unserialize($row["address"])["city"])) echo unserialize($row["address"])["city"]; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>State:</label>
                                        <p><?php if (isset(unserialize($row["address"])["state"])) echo unserialize($row["address"])["state"]; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="btns mt-5">
                                <input type="submit" value="Next" id="next_btn" />
                                <input type="reset" value="Edit" class="edit_btn" />
                            </div>
                        </div>

                        <!-- //! Edit Profile Form -->
                        <div id="edit_profile">
                            <h1>Edit Profile</h1>

                            <div class="container">
                                <form action="verify.php" method="post" enctype="multipart/form-data" novalidate>
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Profile Picture:</label>
                                            <input type="file" name="profile_img" value="C:/xampp/htdocs/php/medicine_website/user_panel/profile/profile_imgs/<?php echo $row["profile_img"]; ?>" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Name:</label>
                                            <input type="text" name="name" value="<?php echo $row["name"]; ?>" class="form-control" placeholder="User Name" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Phone:</label>
                                            <input type="text" name="phone" value="<?php if ($row["phone"] != 0) {
                                                                                        echo $row["phone"];
                                                                                    } ?>" class="form-control" maxlength="14" placeholder="0123456789" />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Gender:</label>
                                            <input type="text" name="gender" value="<?php echo $row["gender"]; ?>" class="form-control" placeholder="Male/Female" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Age:</label>
                                            <input type="number" name="age" value="<?php if ($row["age"] != 0) {
                                                                                        echo $row["age"];
                                                                                    } ?>" class="form-control" placeholder="Age" />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Email ID:</label>
                                            <input type="email" value="<?php echo $row["email"]; ?>" class="form-control" placeholder="Email ID" readonly />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Password:</label>
                                            <input type="password" value="<?php echo $row["pass"]; ?>" class="form-control" placeholder="Password" readonly />
                                            <a href="http://localhost/php/medicine_website/user_panel/forgot_pass/forgot_pass.php">Forget Password?</a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-8">
                                            <label class="form-label">Street:</label>
                                            <input type="text" name="street" value="<?php echo unserialize($row["address"])["street"]; ?>" class="form-control" placeholder="Apartment Name" />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">House no.:</label>
                                            <input type="text" name="house_no" value="<?php echo unserialize($row["address"])["house_no"]; ?>" class="form-control" placeholder="D/302" />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-8">
                                            <label class="form-label">Apartment suite(optional):</label>
                                            <input type="text" name="suite" value="<?php echo unserialize($row["address"])["suite"]; ?>" class="form-control" placeholder="near by Apartment Name" />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Pincode:</label>
                                            <input type="number" name="pincode" value="<?php echo unserialize($row["address"])["pincode"]; ?>" class="form-control" placeholder="382480" />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label">City:</label>
                                            <input type="text" name="city" value="<?php echo unserialize($row["address"])["city"]; ?>" class="form-control" placeholder="Ahmedabad" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">State:</label>
                                            <input type="text" name="state" value="<?php echo unserialize($row["address"])["state"]; ?>" class="form-control" placeholder="Gujarat" />
                                        </div>
                                    </div>
                                    <div class="btns mt-5">
                                        <input type="submit" value="Update" id="update_btn" name="update" />
                                        <input type="reset" value="Reset" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </main>
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