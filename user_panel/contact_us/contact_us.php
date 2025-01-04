<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact US</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>
</head>
<style>
    <?php include("contact_us.css"); ?>
</style>
<script>
    $(document).ready(function() {
        //! fadeOut Form Error & success
        $("#form_error, #form_succ").fadeOut(15000);
    });
</script>

<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <div id="contact_form">
            <h1>Contact us</h1>
            <hr />

            <div>
                <div id="company_details">
                    <img src="contact_us.jpg" alt="">
                    <div id="details">
                        <p>
                            <b>Company: </b>healthGroup pvt. ltd.
                        </p>
                        <p>
                            <b>Email: </b>healthgroup001@gmail.com
                        </p>
                        <p>
                            <b>Phone: </b>9010203040
                        </p>
                        <p>
                            <b>Address: </b>34, Kameshwar park, opp. Swaminarayan Mandir, Hirawadi road, Saidpur bogha, Ahmedabad, Gujarat India-382 345
                        </p>
                    </div>
                </div>

                <div id="form">
                    <!-- //! Form Error or Success -->
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

                    <!-- //! Main Form -->
                    <h1>Place Your query here...</h1>
                    <form action="place_query.php" method="post" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label">Name:</label>
                                <input type="text" name="name" class="form-control" placeholder="User Name" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label">Email ID:</label>
                                <input type="email" name="email" class="form-control" placeholder="Email ID" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label">Phone:</label>
                                <input type="text" name="phone" class="form-control" maxlength="10" placeholder="Phone no." />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label">Query:</label>
                                <textarea type="text" name="query" class="form-control" placeholder="Place your query here..." rows="4"></textarea>
                            </div>
                        </div>
                        <div class="btns mt-5">
                            <input type="submit" value="Send" id="send_btn" name="send" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <img src="contact_us2.png" alt="">
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