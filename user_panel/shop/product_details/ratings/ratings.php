<?php
include("C:/xampp/htdocs/php/medicine_website/database.php");

//! Get raters
if (isset($_SESSION["email"])) {
    $sel = $conn->prepare("SELECT * FROM `ratings` WHERE `email`='" . $_SESSION["email"] . "' AND `item_code`='" . $_SESSION["item_code"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $row) {
        if ($row["status"] == "rate" || $row["status"]=="both") {
            $contain_rating = $row["rate"];
        }
    }
}
?>

<style>
    <?php include("ratings.css"); ?>
</style>

<script>
    <?php include("ratings.js"); ?>
</script>

<?php include("calculate.php"); ?>

<div id="ratings">
    <h1>Ratings & Reviews</h1>
    <hr />
    <div class="d-flex">
        <div id="show_ratings">
            <h1><?php echo $avg_rate; ?><i class="fa-solid fa-star"></i></h1>
            <div class="progress_bar progress_bar5">
                <span>5 <i class="fa-solid fa-star"></i></span>
                <progress value="<?php echo $avg_five_star; ?>" max="100"></progress>
            </div>
            <div class="progress_bar progress_bar4">
                <span>4 <i class="fa-solid fa-star"></i></span>
                <progress value="<?php echo $avg_four_star; ?>" max="100"></progress>
            </div>
            <div class="progress_bar progress_bar3">
                <span>3 <i class="fa-solid fa-star"></i></span>
                <progress value="<?php echo $avg_three_star; ?>" max="100"></progress>
            </div>
            <div class="progress_bar progress_bar2">
                <span>2 <i class="fa-solid fa-star"></i></span>
                <progress value="<?php echo $avg_two_star; ?>" max="100"></progress>
            </div>
            <div class="progress_bar progress_bar1">
                <span>1 <i class="fa-solid fa-star"></i></span>
                <progress value="<?php echo $avg_one_star; ?>" max="100" data-label="50% Complete"></progress>
            </div>
        </div>
        <hr>

        <!-- //! Give ratings -->
        <div id="give_ratings">
            <h2 id="error">You already rate this product</h2>
            <?php if (isset($_SESSION["form_err"])) { ?>
                <h2 style="color:red;font-size:0.7em;" id="form_err"><?php echo $_SESSION["form_err"]; ?></h2>
            <?php } ?>
            <?php if (isset($_SESSION["success"])) { ?>
                <h2 id="success"><?php echo $_SESSION["success"]; ?></h2>
            <?php } ?>
            <div>
                <span>Rate Product</span>
                <?php if (isset($_SESSION["email"])) {

                    if (isset($contain_rating)) { ?>
                        <!-- //! Already Rate -->
                        <div class="stars already">
                            <?php $i = 0;
                            while ($i < 5) {
                                if ($i < $contain_rating) { ?>
                                    <a href="javascript:SendPlaylist(); return false;"><i class="fa-solid fa-star" style="color:#ffaf1a;"></i></a>
                                <?php }
                                //
                                else { ?>
                                    <a href="javascript:SendPlaylist(); return false;"><i class="fa-solid fa-star"></i></a>
                            <?php }
                                $i++;
                            } ?>
                        </div>
                    <?php }
                    //
                    else { ?>
                        <div class="stars">
                            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/ratings/rate.php?star=5"><i class="fa-solid fa-star"></i></a>
                            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/ratings/rate.php?star=4"><i class="fa-solid fa-star"></i></a>
                            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/ratings/rate.php?star=3"><i class="fa-solid fa-star"></i></a>
                            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/ratings/rate.php?star=2"><i class="fa-solid fa-star"></i></a>
                            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/ratings/rate.php?star=1"><i class="fa-solid fa-star"></i></a>
                        </div>
                    <?php }
                }
                //
                else { ?>
                    <div class="stars">
                        <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-star"></i></a>
                        <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-star"></i></a>
                        <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-star"></i></a>
                        <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-star"></i></a>
                        <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-star"></i></a>
                    </div>
                <?php } ?>
            </div>
            <?php if (!isset($_SESSION["email"])) { ?>
                <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-regular fa-pen-to-square"></i> Write a Review</a>
            <?php }
            //
            else { ?>
                <button id="write_review"><i class="fa-regular fa-pen-to-square"></i> Write a Review</button>
            <?php } ?>
        </div>
    </div>
</div>

<!-- //! Review the product -->
<div id="review_form">
    <form action="http://localhost/php/medicine_website/user_panel/shop/product_details/ratings/rate.php" method="post" enctype="multipart/form-data">
        <div class="row mb-5">
            <div class="col-md-12">
                <label class="form-label">Review Heading</label>
                <input type="text" name="review_head" class="form-control" placeholder="Review Heading" />
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <label class="form-label">Review Description</label>
                <textarea type="text" name="review_des" class="form-control" placeholder="Enter your review" rows="3"></textarea>
            </div>
        </div>
        <div class="btns mt-5">
            <input type="submit" value="Submit" name="submit" />
        </div>
    </form>
</div>


<?php
$sel = $conn->prepare("SELECT * FROM `ratings` INNER JOIN `user_login_data` ON ratings.email=user_login_data.email  WHERE `item_code`='" . $_SESSION["item_code"] . "' ORDER BY `time`");
$sel->execute();
$sel = $sel->fetchAll();
?>
<!-- //! Show Reviews -->
<div id="show_review">
    <h1>Reviews</h1>
    <hr />
    <?php
    $email = "";
    foreach ($sel as $row) {
        if (isset($_SESSION["email"]) && $row["email"] == $_SESSION["email"]) {
            disRev($row);
            $email = $row["email"];
        }
    }
    foreach ($sel as $row) {
        if ($row["email"] != $email)
            disRev($row);
    }
    ?>
</div>


<?php

function disRev($row)
{ ?>
    <div id="review">
        <div id="user">
            <?php if ($row["profile_img"] != null) { ?>
                <img src="http://localhost/php/medicine_website/user_panel/profile/profile_imgs/<?php echo $row["profile_img"]; ?>" alt="">
            <?php } else { ?>
                <img src="http://localhost/php/medicine_website/user_panel/profile/user.png" alt="">
            <?php } ?>
            <span><?php echo $row["name"]; ?></span>
        </div>
        <h2><?php if (isset(unserialize($row["review"])[0])) echo unserialize($row["review"])[0]; ?></h2>
        <?php
        if ($row["rate"] != 0) {
            $i = 0;
            while ($i < 5) {
                if ($i < $row["rate"]) { ?>
                    <i class="fa-solid fa-star" style="color:#ffaf1a;"></i>
                <?php }
                //
                else { ?>
                    <i class="fa-solid fa-star"></i>
        <?php }
                $i++;
            }
        } ?>
        <p><?php if (isset(unserialize($row["review"])[1])) echo unserialize($row["review"])[1]; ?></p>

        <?php
        if (isset($_SESSION["email"]) && $row["email"] == $_SESSION["email"]) { ?>
            <a href="./ratings/del_review.php"><i class="fa-solid fa-trash"></i></a>
        <?php } ?>
        <span id="time"><?php $time = strtotime($row["time"]);
                        echo date("d M, Y", $time); ?></span>
    </div>
<?php }

if (isset($_SESSION["success"])) {
    unset($_SESSION["success"]);
}
if (isset($_SESSION["form_err"])) {
    unset($_SESSION["form_err"]);
}
?>