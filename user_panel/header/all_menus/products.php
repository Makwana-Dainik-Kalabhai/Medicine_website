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
            <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?category=<?php echo $row["category"]; ?>"><?php echo $row["category"]; ?> <i class="fa-solid fa-chevron-right"></i></a>
        <?php
        } ?>
    </div>

    <a href="">Mobile X-Ray Machine</a>
    <a href="" style="color: #0000b3;">Explore More%</a>
</div>

</html>