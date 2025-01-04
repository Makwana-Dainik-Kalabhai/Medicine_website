<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_POST["add_category"])) {
    if ($_FILES["cat_img"]["name"] == null) {
        $_SESSION["error"] = "Please! Select the File"; ?>

        <script>
            window.history.back();
        </script>
    <?php
        return;
    }
    if ($_POST["category"] == null) {
        $_SESSION["error"] = "Please! Enter the Category Name"; ?>

        <script>
            window.history.back();
        </script>
    <?php
        return;
    }
    if ($_POST["product_id"] == null) {
        $_SESSION["error"] = "Please! Enter the Product ID"; ?>

        <script>
            window.history.back();
        </script>
        <?php
        return;
    }

    $cat = $_POST["category"];
    $cat_img = $_FILES["cat_img"]["name"];
    $product_id = $_POST["product_id"];

    $sel = $conn->prepare("SELECT * FROM `products`");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($product_id == $r["product_id"]) {
            $_SESSION["error"] = "Please! Change the Product ID, This Product ID is already exist"; ?>
            <script>
                window.history.back();
            </script>
    <?php return;
        }
    }

    $in = $conn->prepare("INSERT INTO `products` VALUES(NOW(), '$cat','$cat_img','','','','','','','','','','','','','','','','','','','','','','medicine')");
    $in->execute();

    move_uploaded_file($_FILES["cat-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/category_img/" . $_FILES["cat-img"]["name"] . "");
    $_SESSION["success"] = "Product Category details updated successfully";
    ?>
    <script>
        window.history.back();
    </script>
<?php }


// if (isset($_POST["update-product"])) {

//     class Product
//     {
//         public $name;
//         public $definition;
//         public $discount;
//         public $offer_price;
//         public $price;
//         public $quantity;
//         public $weight;
//         public $expiry;
//         public $delivery_date;
//         public $link;

//         function insert()
//         {
//             $this->name = $_POST["name"];
//             $this->definition = $_POST["definition"];
//             $this->discount = $_POST["discount"];
//             $this->offer_price = $_POST["offer-price"];
//             $this->price = $_POST["price"];
//             $this->quantity = $_POST["quantity"];
//             $this->weight = $_POST["weight"];
//             $this->expiry = $_POST["expiry"];
//             $this->delivery_date = $_POST["delivery-date"];
//             $this->link = $_POST["link"];
//         }

//         function update()
//         {
//             global $conn;

//             $update = $conn->prepare("UPDATE `products` SET `name`='" . $this->name . "',`definition`='" . $this->definition . "',`discount`='" . $this->discount . "',`offer_price`='" . $this->offer_price . "',`price`='" . $this->price . "',`quantity`='" . $this->quantity . "',`weight`='" . $this->weight . "',`expiry`='" . $this->expiry . "',`delivery_date`='" . $this->delivery_date . "',`link`='" . $this->link . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
//             $update->execute();
//         }
//     }

//     $p = new Product();
//     $p->insert();
//     $p->update();

// $_SESSION["success"] = "Product details updated successfully";
?>
<script>
    // window.history.back();
</script>
<?php //}
