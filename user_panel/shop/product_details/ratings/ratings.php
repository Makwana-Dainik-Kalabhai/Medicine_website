<style>
    <?php include("ratings.css"); ?>
</style>

<script>
    <?php include("ratings.js"); ?>
</script>

<div id="ratings">
    <h1>Ratings & Reviews</h1>
    <hr />
    <div class="d-flex">
        <div id="show_ratings">
            <h1>4.7<i class="fa-solid fa-star"></i></h1>
            <div class="progress_bar">
                <span>5 <i class="fa-solid fa-star"></i></span>
                <div id="progress_bar5">
                    <div role="progressbar" aria-valuenow="20" aria-valuemax="100"></div>
                </div>
                <span> 5%</span>
            </div>
            <div class="progress_bar">
                <span>4 <i class="fa-solid fa-star"></i></span>
                <div id="progress_bar4">
                    <div role="progressbar" aria-valuenow="20" aria-valuemax="100"></div>
                </div>
                <span> 4%</span>
            </div>
            <div class="progress_bar">
                <span>3 <i class="fa-solid fa-star"></i></span>
                <div id="progress_bar3">
                    <div role="progressbar" aria-valuenow="20" aria-valuemax="100"></div>
                </div>
                <span> 3%</span>
            </div>
            <div class="progress_bar">
                <span>2 <i class="fa-solid fa-star"></i></span>
                <div id="progress_bar2">
                    <div role="progressbar" aria-valuenow="20" aria-valuemax="100"></div>
                </div>
                <span> 2%</span>
            </div>
            <div class="progress_bar">
                <span>1 <i class="fa-solid fa-star"></i></span>
                <div id="progress_bar1">
                    <div role="progressbar" aria-valuenow="20" aria-valuemax="100"></div>
                </div>
                <span> 1%</span>
            </div>
        </div>
        <hr>
        <div id="give_ratings">
            <div>
                <span>Rate Product</span>
                <span id="stars">
                    <a href="rate.php?star=1"><i class="fa-solid fa-star"></i></a>
                    <a href="rate.php?star=2"><i class="fa-solid fa-star"></i></a>
                    <a href="rate.php?star=3"><i class="fa-solid fa-star"></i></a>
                    <a href="rate.php?star=4"><i class="fa-solid fa-star"></i></a>
                    <a href="rate.php?star=5"><i class="fa-solid fa-star"></i></a>
                </span>
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
<div id="review">
    <?php include("form.php"); ?>
</div>