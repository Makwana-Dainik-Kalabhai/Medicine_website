<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_POST["update-category"])) {
    if ($_FILES["cat-img"]["name"] == null) {
        $_SESSION["error"] = "Please! Select the File";
        header("Refresh:0; url=http://localhost/php/medicine_website/admin_panel/products/edit_medicine/edit_medicine.php");
        return;
    }

    if (isset($_FILES["cat-img"])) {
        $update = $conn->prepare("UPDATE `products` SET `category`='" . $_POST["category"] . "', `cat_img`='" . $_FILES["cat-img"]["name"] . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");

        move_uploaded_file($_FILES["cat-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/category_img/" . $_FILES["cat-img"]["name"] . "");
    } else {
        $update = $conn->prepare("UPDATE `products` SET `category`='" . $_POST["category"] . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    }
    $update->execute();

    $_SESSION["success"] = "Product Category details updated successfully";
?>
    <script>
        window.history.back();
    </script>
<?php }


if (isset($_POST["update-product"])) {

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
            $this->expiry = $_POST["expiry"];
            $this->delivery_date = $_POST["delivery-date"];
            $this->link = $_POST["link"];
        }

        function update()
        {
            global $conn;

            $update = $conn->prepare("UPDATE `products` SET `name`='" . $this->name . "',`definition`='" . $this->definition . "',`discount`='" . $this->discount . "',`offer_price`='" . $this->offer_price . "',`price`='" . $this->price . "',`quantity`='" . $this->quantity . "',`weight`='" . $this->weight . "',`expiry`='" . $this->expiry . "',`delivery_date`='" . $this->delivery_date . "',`link`='" . $this->link . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
            $update->execute();
        }
    }

    $p = new Product();
    $p->insert();
    $p->update();

    $_SESSION["success"] = "Product details updated successfully";
?>
    <script>
        window.history.back();
    </script>
<?php }
