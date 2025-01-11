<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");



if (isset($_POST["delete-product"])) {
    $del = $conn->prepare("DELETE FROM `products` WHERE `product_id`=1047");
    $del->execute(); ?>

    <script>
        window.history.go(-2);
    </script>

    <?php return;
}



//* Add Category Details
if (isset($_POST["add_category"])) {
    if ($_FILES["cat_img"]["name"] == null) {
        $_SESSION["cat_error"] = "Please! Select the File"; ?>

        <script>
            window.history.back();
        </script>
    <?php
        return;
    }
    if ($_POST["category"] == null) {
        $_SESSION["cat_error"] = "Please! Enter the Category Name"; ?>

        <script>
            window.history.back();
        </script>
    <?php
        return;
    }
    if ($_POST["product_id"] == null) {
        $_SESSION["cat_error"] = "Please! Enter the Product ID"; ?>

        <script>
            window.history.back();
        </script>
        <?php
        return;
    }
    $sel = $conn->prepare("SELECT * FROM `products`");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($_POST["product_id"] == $r["product_id"]) {
            $_SESSION["cat_error"] = "Please! Change the Product ID, This Product ID is already exist"; ?>
            <script>
                window.history.back();
            </script>
    <?php return;
        }
    }

    $cat = $_POST["category"];
    $cat_img = $_FILES["cat_img"]["name"];
    $item_img = "";
    $name = "";
    $def = "";
    $off_price = "";
    $price = "";
    $discount = "";
    $weight = "";
    $quantity = "";
    $desc_img = "";
    $desciption = "";
    $features = "";
    $specification = "";
    $link = "";
    $expiry = "";
    $benefits = "";
    $how_use = "";
    $safety = "";
    $other = "";
    $faqs = "";
    $del_date = "";
    $product_id = $_POST["product_id"];

    $in = $conn->prepare("INSERT INTO `products` VALUES(NOW(), '$cat','$cat_img','$item_img','$name','$def','$off_price','$price','$discount','$weight','$quantity','$desc_img','$desciption','$features','$specification','$link','$expiry','$benefits','$how_use','$safety','$other','$faqs','$del_date','$product_id','" . $_SESSION["status"] . "')");

    if ($in->execute()) {

        move_uploaded_file($_FILES["cat_img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/category_img/" . $_FILES["cat_img"]["name"] . "");

        $_SESSION["cat_success"] = "Product Category details added successfully";
        $_SESSION["product_id"] = $product_id;
    }
    header("Location: http://localhost/php/medicine_website/admin_panel/products/add_product/add_product.php");
}





//* Add Product Details
if (isset($_POST["add-product-details"])) {

    class Product
    {
        public $name;
        public $definition;
        public $discount;
        public $offer_price;
        public $price;
        public $quantity;
        public $weight;
        public $expiry;
        public $delivery_date;
        public $link;

        function insert()
        {
            $this->name = $_POST["name"];
            $this->definition = $_POST["definition"];
            $this->discount = $_POST["discount"];
            $this->offer_price = $_POST["offer-price"];
            $this->price = $_POST["price"];
            $this->quantity = $_POST["quantity"];
            $this->weight = $_POST["weight"];

            if ($_SESSION["status"] == "medicine") {
                $this->expiry = $_POST["expiry"];
            }
            $this->delivery_date = $_POST["delivery-date"];
            $this->link = $_POST["link"];
        }

        function update()
        {
            global $conn;

            if ($_SESSION["status"] == "medicine") {
                $update = $conn->prepare("UPDATE `products` SET `name`='" . $this->name . "',`definition`='" . $this->definition . "',`discount`='" . $this->discount . "',`offer_price`='" . $this->offer_price . "',`price`='" . $this->price . "',`quantity`='" . $this->quantity . "',`weight`='" . $this->weight . "',`expiry`='" . $this->expiry . "',`delivery_date`='" . $this->delivery_date . "',`link`='" . $this->link . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
            } //
            else {
                $update = $conn->prepare("UPDATE `products` SET `name`='" . $this->name . "',`definition`='" . $this->definition . "',`discount`='" . $this->discount . "',`offer_price`='" . $this->offer_price . "',`price`='" . $this->price . "',`quantity`='" . $this->quantity . "',`weight`='" . $this->weight . "',`expiry`='',`delivery_date`='" . $this->delivery_date . "',`link`='" . $this->link . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
            }
            $update->execute();
        }
    }

    $p = new Product();
    $p->insert();
    $p->update();

    $_SESSION["product_success"] = "Product details Added Successfully";

    header("Location: http://localhost/php/medicine_website/admin_panel/products/add_product/add_product.php");
}
