<?php

include("C:/xampp/htdocs/php/medicine_website/database.php");

if ($_POST["search_val"] != null) {

    $select = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%".$_POST["search_val"]."%'");
    $select->execute();

    $select = $select->fetchAll();

    foreach ($select as $row) { ?>
        <div><a href='http://localhost/php/medicine_website/user_panel/shop/products/product_details/product_details.php?item_code=<?php echo $row["item_code"]; ?>'><i class='fa-solid fa-magnifying-glass'></i>&emsp;<?php echo $row["name"]; ?></a></div>
<?php }
}
exit;
?>