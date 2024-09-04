<?php

include("C:/xampp/htdocs/php/medicine_website/database.php");

if ($_POST["firstName"] != null) {

    if ($_POST["key"] == "Backspace") {
        $data = $_POST["firstName"];
    }
    else {
        $data = $_POST["firstName"] . $_POST["key"];
    }
    $select = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%$data%'");
    $select->execute();

    $select = $select->fetchAll();

    foreach ($select as $row) { ?>
        <div><a href='http://localhost/php/medicine_website/user_panel/shop/products/product_details/product_details.php?item_code=<?php echo $row["item_code"]; ?>'><i class='fa-solid fa-magnifying-glass'></i>&emsp;<?php echo $row["name"]; ?></a></div>
<?php }
}
exit;
?>