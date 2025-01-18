<?php
include("C:/xampp/htdocs/php/medicine_website/database.php");

if ($_POST["search_val"] != null) {
    $select = $conn->prepare("SELECT * FROM `products` WHERE `category` LIKE '%" . $_POST["search_val"] . "%' GROUP BY `category`");
    $select->execute();
    $select = $select->fetchAll();

    foreach ($select as $row) { ?>
        <a href='http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?category=<?php echo $row["category"]; ?>&status=<?php echo $row["status"]; ?>'>
            <div class="search-img"><img src="http://localhost/php/medicine_website/user_panel/shop/category_img/<?php echo $row["cat_img"]; ?>" alt="" /></div>
            <div class="search-name">
                <?php $j = 0;
                $category = strtolower($row["category"]);

                for ($i = 0; $i < strlen($category); $i++) {
                    if ($i + 1 < strlen($category) && isset($_POST["search_val"][$j]) && isset($_POST["search_val"][$j + 1]) && $_POST["search_val"][$j] == $category[$i] && $_POST["search_val"][$j + 1] == $category[$i + 1]) {

                        while (isset($_POST["search_val"][$j])) {
                            echo "<b>" . $_POST["search_val"][$j] . "</b>";
                            $i++;
                            $j++;
                        }
                        $i--;
                    } else if (isset($_POST["search_val"][$j]) && (!isset($_POST["search_val"][$j + 1])) && $_POST["search_val"][$j] == $category[$i]) {
                        echo "<b>" . $_POST["search_val"][$j] . "</b>";
                        $j++;
                    } else {
                        echo $category[$i];
                    }
                } ?>
            </div>
        </a>
    <?php
    }

    $select = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%" . $_POST["search_val"] . "%'");
    $select->execute();
    $select = $select->fetchAll();

    foreach ($select as $row) { ?>
        <a href='http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?product_id=<?php echo $row["product_id"]; ?>&status=<?php echo $row["status"]; ?>'>
            <div class="search-img"><img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>" alt="" /></div>

            <div class="search-name">
                <?php $j = 0;
                $name = strtolower($row["name"]);

                for ($i = 0; $i < strlen($name); $i++) {
                    if ($i + 1 < strlen($name) && isset($_POST["search_val"][$j]) && isset($_POST["search_val"][$j + 1]) && $_POST["search_val"][$j] == $name[$i] && $_POST["search_val"][$j + 1] == $name[$i + 1]) {

                        while (isset($_POST["search_val"][$j])) {
                            echo "<b>" . $_POST["search_val"][$j] . "</b>";
                            $i++;
                            $j++;
                        }
                        $i--;
                    } else if (isset($_POST["search_val"][$j]) && (!isset($_POST["search_val"][$j + 1])) && $_POST["search_val"][$j] == $name[$i]) {
                        echo "<b>" . $_POST["search_val"][$j] . "</b>";
                        $j++;
                    } else {
                        echo $name[$i];
                    }
                } ?>
            </div>
        </a>
<?php
    }
}
?>