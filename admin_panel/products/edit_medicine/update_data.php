<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_POST["update-category"])) {
    if ($_FILES["cat-img"]["name"] == null) {
        $_SESSION["cat_error"] = "Please! Select the File";

        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
        }
        return;
    }

    if (str_contains($_FILES["cat-img"]["name"], "'")) {
        $_FILES["cat-img"]["name"] = explode("'", $_FILES["cat-img"]["name"]);
        $_FILES["cat-img"]["name"] = $_FILES["cat-img"]["name"][0] . $_FILES["cat-img"]["name"][1];
    }

    if (isset($_FILES["cat-img"])) {
        $update = $conn->prepare("UPDATE `products` SET `category`='" . $_POST["category"] . "', `cat_img`='" . $_FILES["cat-img"]["name"] . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");

        move_uploaded_file($_FILES["cat-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/category_img/" . $_FILES["cat-img"]["name"] . "");
    } else {
        $update = $conn->prepare("UPDATE `products` SET `category`='" . $_POST["category"] . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    }
    $update->execute();

    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
    }
}


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
            //* Name
            $this->name = $_POST["name"];
            if (str_contains($_POST["name"], "'")) {
                $_POST["name"] = explode("'", $_POST["name"]);
                $this->name = $_POST["name"][0] . $_POST["name"][1];
            }

            //* Definition
            $this->definition = $_POST["definition"];
            if (str_contains($_POST["definition"], "'")) {
                $_POST["definition"] = explode("'", $_POST["definition"]);
                $this->definition = $_POST["definition"][0] . $_POST["definition"][1];
            }

            //* Discount
            $this->discount = $_POST["discount"];
            //* Offer Price
            $this->offer_price = $_POST["offer-price"];
            //* Price
            $this->price = $_POST["price"];
            //* Quantity
            $this->quantity = $_POST["quantity"];

            //* Weight
            $this->weight = $_POST["weight"];
            if (str_contains($_POST["weight"], "'")) {
                $_POST["weight"] = explode("'", $_POST["weight"]);
                $this->weight = $_POST["weight"][0] . $_POST["weight"][1];
            }

            //* Expiry
            $this->expiry = $_POST["expiry"];
            if (str_contains($_POST["expiry"], "'")) {
                $_POST["expiry"] = explode("'", $_POST["expiry"]);
                $this->expiry = $_POST["expiry"][0] . $_POST["expiry"][1];
            }

            //* Delivery-Date
            $this->delivery_date = $_POST["delivery-date"];

            //* Link
            $this->link = $_POST["link"];
            if (str_contains($_POST["link"], "'")) {
                $_POST["link"] = explode("'", $_POST["link"]);
                $this->link = $_POST["link"][0] . $_POST["link"][1];
            }
        }

        function update()
        {
            global $conn;
            $update = $conn->prepare("UPDATE `products` SET `name`='" . $this->name . "',`definition`='" . $this->definition . "',`discount`='" . $this->discount . "',`offer_price`='" . $this->offer_price . "',`price`='" . $this->price . "',`quantity`='" . $this->quantity . "',`weight`='" . $this->weight . "',`expiry`='" . $this->expiry . "',`delivery_date`='" . $this->delivery_date . "',`link`='" . $this->link . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
            if ($update->execute()) {
                $_SESSION["pr_details_suc"] = "Product Details are updated successfully";
            }
        }
    }

    $p = new Product();
    $p->insert();
    $p->update();

    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
    }
}
