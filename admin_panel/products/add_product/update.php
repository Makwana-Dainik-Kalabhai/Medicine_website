<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");


//* Add Category Details
if (isset($_POST["add_category"])) {
    if (isset($_POST["new-category"]) && $_POST["new-category"] == null) {
        $_SESSION["cat_error"] = "Please! Enter the Category Name";

        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
        }
        return;
    } else {
        $cat = $conn->prepare("SELECT * FROM `products` GROUP BY `category`");
        $cat->execute();
        $cat = $cat->fetchAll();

        foreach ($cat as $r) {
            if (isset($_POST["new-category"]) && $_POST["new-category"] == $r["category"]) {
                $_SESSION["cat_error"] = "Category is Already Exist";

                if (isset($_SERVER['HTTP_REFERER'])) {
                    header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
                }
                return;
            }
        }
    }

    if ($_POST["product_id"] == null) {
        $_SESSION["cat_error"] = "Please! Enter the Product ID";

        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
        }
        return;
    }

    if (isset($_POST["new-category"]) && $_FILES["cat-img"]["name"] == null) {
        $_SESSION["cat_error"] = "Please! Select the Category Image";

        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
        }
        return;
    }
    if (isset($_POST["old-category"]) && $_FILES["cat-img"]["name"] == null) {
        $cat_img = $conn->prepare("SELECT `cat_img` FROM `products` WHERE `category`='" . $_POST["old-category"] . "'");
        $cat_img->execute();
        $cat_img = $cat_img->fetchAll();
        $cat_img = $cat_img[0][0];
    }

    if (str_contains($_FILES["cat-img"]["name"], "'")) {
        $_FILES["cat-img"]["name"] = explode("'", $_FILES["cat-img"]["name"]);
        $_FILES["cat-img"]["name"] = $_FILES["cat-img"]["name"][0] . $_FILES["cat-img"]["name"][1];
    }

    $sel = $conn->prepare("SELECT * FROM `products`");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($_POST["product_id"] == $r["product_id"]) {
            $_SESSION["cat_error"] = "Please! Change the Product ID, This Product ID is already exist";

            if (isset($_SERVER['HTTP_REFERER'])) {
                header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
            }
            return;
        }
    }

    $cat = (isset($_POST["new-category"])) ? $_POST["new-category"] : $_POST["old-category"];
    if (!isset($cat_img)) {
        $cat_img = $_FILES["cat-img"]["name"];
    }
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
        if (!isset($_POST["old-category"])) {
            move_uploaded_file($_FILES["cat-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/category_img/" . $_FILES["cat-img"]["name"] . "");
        }

        $_SESSION["cat_success"] = "Product Category Details are Added Successfully";
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
            //* Name
            if (str_contains($_POST["name"], "'")) {
                $_POST["name"] = explode("'", $_POST["name"]);
                $this->name = $_POST["name"][0] . $_POST["name"][1];
            } else {
                $this->name = $_POST["name"];
            }

            //* Definition
            if (str_contains($_POST["definition"], "'")) {
                $_POST["definition"] = explode("'", $_POST["definition"]);
                $this->definition = $_POST["definition"][0] . $_POST["definition"][1];
            } else {
                $this->definition = $_POST["definition"];
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
            if (str_contains($_POST["weight"], "'")) {
                $_POST["weight"] = explode("'", $_POST["weight"]);
                $this->weight = $_POST["weight"][0] . $_POST["weight"][1];
            } else {
                $this->weight = $_POST["weight"];
            }

            //* Expiry
            if ($_SESSION["status"] == "medicine") {
                if (str_contains($_POST["expiry"], "'")) {
                    $_POST["expiry"] = explode("'", $_POST["expiry"]);
                    $this->expiry = $_POST["expiry"][0] . $_POST["expiry"][1];
                } else {
                    $this->expiry = $_POST["expiry"];
                }
            }

            //* Delivery-Date
            if (str_contains($_POST["delivery-date"], "'")) {
                $_POST["delivery-date"] = explode("'", $_POST["delivery-date"]);
                $this->delivery_date = $_POST["delivery-date"][0] . $_POST["delivery-date"][1];
            } else {
                $this->delivery_date = $_POST["delivery-date"];
            }

            //* Link
            if (str_contains($_POST["link"], "'")) {
                $_POST["link"] = explode("'", $_POST["link"]);
                $this->link = $_POST["link"][0] . $_POST["link"][1];
            } else {
                $this->link = $_POST["link"];
            }
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

    $_SESSION["pr_details_suc"] = "Product Details are Added Successfully";

    header("Location: http://localhost/php/medicine_website/admin_panel/products/add_product/add_product.php");
}
