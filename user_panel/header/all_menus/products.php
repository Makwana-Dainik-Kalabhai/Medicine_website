<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    <?php
    include("C:/xampp/htdocs/php/medicine_website/user_panel/header/all_menus/category.css");
    ?>
</style>

<div id="main">
    <h1>Products</h1>
    <hr>

    <?php
    include("C:/xampp/htdocs/php/medicine_website/database.php");

    $sel = $conn->prepare("SELECT * FROM `products` GROUP BY `category`");
    $sel->execute();
    $sel = $sel->fetchAll();
    ?>

    <div class="category">
        <?php foreach ($sel as $row) { ?>
            <a href="http://localhost/php/medicine_website/user_panel/shop/products/pr_main_page.php?category=<?php echo $row["category"]; ?>"><?php echo $row["category"]; ?> <i class="fa-solid fa-chevron-right"></i></a>
        <?php
        } ?>
    </div>

    <!-- <a href="">Oxygen Concentrator <i class="fa-solid fa-chevron-right"></i></a>
        <div class="sub_category">
            <a href="">5 LPM</a>
            <a href="">9 LPM</a>
            <a href="">10 LPM</a>
        </div>
    </div>
    <div class="category">
        <a href="">Portable Oxygen Concentrator <i class="fa-solid fa-chevron-right"></i></a>
        <div class="sub_category">
            <a href="">Continues Mode</a>
            <a href="">Pulse Mode</a>
            <a href="">Pulse & Continues Mode</a>
        </div>
    </div>

    <div class="category">
        <a href="">CPAP Machines <i class="fa-solid fa-chevron-right"></i></a>
        <div class="sub_category">
            <a href="">Auto CPAP</a>
            <a href="">Travel CPAP</a>
            <a href="">Economy Range</a>
            <a href="">Fixed PAP</a>
        </div>
    </div>

    <div class="category">
        <a href="">BIPAP & NIV <i class="fa-solid fa-chevron-right"></i></a>
        <div class="sub_category">
            <a href="">Auto BIPAP</a>
            <a href="">NIV</a>
            <a href="">BIPAP Filters</a>
        </div>
    </div>

    <div class="category">
        <a href="">CPAP BIPAP Masks <i class="fa-solid fa-chevron-right"></i></a>
        <div class="sub_category">
            <a href="">Full Face Masks</a>
            <a href="">Nasal Masks</a>
            <a href="">Pillow Masks</a>
        </div>
    </div>

    <div class="category">
        <a href="">Wheelchairs <i class="fa-solid fa-chevron-right"></i></a>
        <div class="sub_category">
            <a href="">Foldable Wheelchairs</a>
            <a href="">Commode Wheelchairs</a>
            <a href="">Electric Wheelchairs</a>
        </div>
    </div> -->

    <a href="">Mobile X-Ray Machine</a>
    <a href="" style="color: #0000b3;">Explore More%</a>
</div>

</html>