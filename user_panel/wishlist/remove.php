<?php
session_start();
if (!isset($_SESSION["email"])) { ?>
    <script>
        window.history.go(-2);
    </script>
<?php }

include("C:/xampp/htdocs/php/medicine_website/database.php");

$delete = $conn->prepare("DELETE FROM `wishlist` WHERE `email`='" . $_SESSION["email"] . "' AND `product_id`='" . $_GET["remove_item"] . "'");
$delete->execute();

header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/wishlist/wishlist.php")

?>