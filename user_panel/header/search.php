<?php
include("C:/xampp/htdocs/php/medicine_website/database.php");

if ($_POST["search_val"] != null) {
    $select = $conn->prepare("SELECT * FROM `products` WHERE `category` LIKE '%" . $_POST["search_val"] . "%' GROUP BY `category`");
    $select->execute();
    $select = $select->fetchAll();

    foreach ($select as $row) { ?>
        <div><a href='http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?category=<?php echo $row["category"]; ?>&status=<?php echo $row["status"]; ?>'><i class='fa-solid fa-magnifying-glass'></i>&emsp;<?php echo $row["category"]; ?></a></div>
    <?php
    }

    $select = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%" . $_POST["search_val"] . "%'");
    $select->execute();
    $select = $select->fetchAll();

    foreach ($select as $row) { ?>
        <div><a href='http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?product_id=<?php echo $row["product_id"]; ?>'><i class='fa-solid fa-magnifying-glass'></i>&emsp;<?php echo $row["name"]; ?></a></div>
<?php
    }
}
?>