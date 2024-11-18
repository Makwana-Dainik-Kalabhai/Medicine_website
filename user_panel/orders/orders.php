<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");
?>

<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Purchase Now</title>
<?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>

<style>
    <?php include("orders.css"); ?>
</style>

<script>
    <?php include("orders.js"); ?>
</script>

<?php
if (isset($_POST["remove_item"])) {
    $up = $conn->prepare("DELETE FROM `cart` WHERE `item_code`='" . $_POST["item_code"] . "'");
    $up->execute();
}
?>

<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main></main>
    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>
</html>