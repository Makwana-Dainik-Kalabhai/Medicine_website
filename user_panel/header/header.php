<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>

<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.css"); ?>
</style>

<script>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.js"); ?>
</script>

<div class="brightness"></div>
<nav id="fake_main_nav"></nav>

<div id="top_load"></div>
<nav id="main_nav" class="header-visible">
    <nav id="nav1">
        <div id="logo">
            <img src="http://localhost/php/medicine_website/user_panel/header/logo1.png" alt="img not found">
        </div>
        <div id="login_btns">
            <?php if (!isset($_SESSION["email"])) { ?>
                <a href="http://localhost/php/medicine_website/user_panel/form/sign_form.php"><i class="fa-solid fa-user-plus"></i> Signup</a>
                <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
            <?php } ?>
        </div>

        <?php if (isset($_SESSION["email"])) { ?>
            <div id="logout_btns">
                <i class="fa-solid fa-user"></i><i class="fa-solid fa-caret-down"></i>
                <a href="http://localhost/php/medicine_website/user_panel/form/logout.php">Logout</a>
            </div>
        <?php } ?>
    </nav>


    <nav id="nav2">
        <div id="menu">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div id="nav2_btns">
            <div class="btn">
                <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?status=device">Products <i class="fa-solid fa-caret-down"></i></a>
                <div><?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/all_menus/products.php"); ?></div>
            </div>

            <div class="btn">
                <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?status=medicine">Medicines <i class="fa-solid fa-caret-down"></i></a>
                <div><?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/all_menus/medicines.php"); ?></div>
            </div>

            <div class="btn">
                <a href="">Lab Test <i class="fa-solid fa-caret-down"></i></a>
                <div><?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/all_menus/appoitment.php"); ?></div>
            </div>

            <div class="btn">
                <a href="">Health Care <i class="fa-solid fa-caret-down"></i></a>
                <div><?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/all_menus/health_care.php"); ?></div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <div id="search_box">
            <form action="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php" method="post">
                <input type="text" id="search_input" name="search_input" placeholder="Search Here..." />
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <?php include("C:/xampp/htdocs/php/medicine_website/database.php"); ?>

            <div id="searched_items">
                <div id="new_items">
                </div>
            </div>
        </div>
    </nav>
</nav>


<nav id="side_nav">
    <div>
    </div>

    <div id="menus">
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/sidenav/sidenav.php"); ?>
    </div>
</nav>