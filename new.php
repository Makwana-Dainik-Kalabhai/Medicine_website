<!--<script src="http://localhost/php/mysql/icecream_website/jquery-3.7.1.js"></script>
<script>
    $(document).ready(() => {
        var i = 2;
        $("#add_d").click(() => {
            $("#add_des").append(`Description${i}: <input type='text' name='des[]' />`);
            i++;
        });
        $("#add_f").click(() => {
            $("#add_fea").append(`Feature${i}: <input type='text' name='fea[]' />`);
            i++;
        });
        $("#add_s").click(() => {
            $("#add_spe").append(`Key${i}: <input type='text' name='key[]' />Specification${i}: <input type='text' name='spe[]' />`);
            i++;
        });
    });
</script>
<style>
    .main {
        width: 600px;
        border: 2px solid;
        padding: 0 15px 10px 15px;
        margin: 10px;
    }

    form {
        margin: 20px 10px;
        padding: 20px;
        background-color: aquamarine;
    }

    fieldset {
        margin: 20px 0;
    }

    input {
        display: block;
        width: 100%;
    }
</style>
<form action="" method="post" enctype="multipart/form-data">
    Category1: <input type="text" name="cat1" />
    Category2: <input type="text" name="cat2" />

    <fieldset>
        <legend>Img1</legend>
        <input type="file" name="img1">
    </fieldset>
    <fieldset>
        <legend>Img2</legend>
        <input type="file" name="img2">
    </fieldset>
    <fieldset>
        <legend>Img3</legend>
        <input type="file" name="img3">
    </fieldset>

    Name: <input type="text" name="name" />
    Definition: <input type="text" name="def" />
    Offer Price: <input type="number" name="off_price" />
    Price: <input type="number" name="price" />
    Discount: <input type="number" name="dis" />
    Weight: <input type="text" name="weight" />

    <div class="main">
        <h1>Description</h1>
        <div id="add_des">
            Description1: <input type="text" name="des[]" />
        </div>
    </div>

    <div class="main">
        <h1>Features</h1>
        <div id="add_fea">
            Featuere1: <input type="text" name="fea[]" />
        </div>
    </div>

    <div class="main">
        <h1>Specification</h1>
        <div id="add_spe">
            Key1: <input type="text" name="key[]" />
            Specification1: <input type="text" name="spe[]" />
        </div>
    </div>

    <input type="submit" value="Submit" name="sub" />
</form>
<button id="add_f">Add Features</button>
<button id="add_s">Add Specification</button>
<button id="add_d">Add Description</button>

<?php
// try {
//     $conn->beginTransaction();
//     //INSERT
//     //UPDATE
//     $conn->commit();
// }
// catch(Exception) {
//     $conn->rollBack();
// }
if (isset($_POST["sub"])) {

    // $cat = [$_POST["cat1"], $_POST["cat2"]];
    // $img = [$_FILES["img1"]["name"], $_FILES["img2"]["name"], $_FILES["img3"]["name"]];
    // $name = $_POST["name"];
    // $def = $_POST["def"];
    // $off_price = $_POST["off_price"];
    // $price = $_POST["price"];
    // $dis = $_POST["dis"];
    // $weight = $_POST["weight"];
    // $quantity = 10;

    // }
    // $des = $_POST["des"];
    // $fea = $_POST["fea"];
    // $spe = [$_POST["key"], $_POST["spe"]];
?>


    <div class="main">
        <hr>
        <h1>Categories...</h1>
        <hr>
        <?php foreach ($cat as $ca) {
            echo "<p>$ca</p>";
        } ?>

<hr>
        <h1>Images...</h1>
        <hr>
        <?php foreach ($img as $im) {
            echo "<p>$im</p>";
        } ?>

<style>
    p {
        font-size: 25px;
            }
        </style>
        
        <hr>
        <p>Name:&emsp;<?php echo $name; ?></p>
        <hr>
        <hr>
        <p>Definition:&emsp;<?php echo $def; ?></p>
        <hr>
        <hr>
        <p>Offer Price:&emsp;<?php echo $off_price; ?></p>
        <hr>
        <hr>
        <p style="text-decoration: line-through;">Price:&emsp;<?php echo $price; ?></p>
        <hr>
        <hr>
        <p>Discount:&emsp;<?php echo $dis; ?></p>
        <hr>
        <hr>
        <p>Weight:&emsp;<?php echo $weight; ?></p>
        <hr>
        
        <hr>
        <h1>Description...</h1>
        <?php foreach ($des as $de) {
            echo "<p>$de</p>";
        } ?>
        <hr>
        <hr>
        <h1>Features...</h1>
        <?php foreach ($fea as $fe) {
            echo "<p>$fe</p>";
        } ?>

        <?php for ($i = 0; $i < sizeof($spe[0]); $i++) {
            foreach ($spe as $sp) { ?>
                <?php echo $sp[$i]; ?>
                <?php }
        } ?>
    </div>
    <?php
}
    ?>-->


<?php
$conn = new PDO("mysql:host=localhost;dbname=medicine_website", "root", "");

// $cat = "cold and fever";
// $item_img = [
//     "Superior Wheelchair 24-inch Rear Mag Wheel(1).jpg",
//     "Superior Wheelchair 24-inch Rear Mag Wheel(2).jpg"
// ];
// $name = "Lama Cough Syrup 100 ml";
// $def = "";
// $off_price = 73.95;
// $price = 85;
// $dis = 13;
// $weight = "100ml";
// $quantity = 10;
// $expiry = "Nov 2026";

// $des_img = [];

// $des = [
//     ["Effective medicine for Cough, Cold, Bronchitis, Whooping Cough, Asthmatic Cough."]
// ];
// $benefit = [
//     ["It may help by thinning and loosening mucus in the airways, clearing congestion and making breathing easier."],
//     ["It may help relieve of cough, sneezing or runny nose due to the common cold."]
// ];
// $how_use = [
//     ["1-2 teaspoon thrice daily or as directed by the physician."]
// ];
// $safety = [
//     "The product information contained herein is for informational purposes only and is not intended to diagnose, treat, or prevent.",
//     "Read the label carefully before use. Do not exceed the recommended dose.",
//     "Keep out of the reach and sight of children."
// ];
// $other_info = [
//     ["Ingredients", "Pipal (Piper longum) Tagar (Valeriana wallichi) Sonth (Zingiber officinale) Nagarmotha (Cyperus rotundus) Kantikari (Solanum Surattense) Tulsi (Ocimum sanctrum) Talispatra (Abies webbiana) Kalimarich (Piper nigrum) Dalchini (Cinnamomum zeylanicum) Apamarg (Achyaranthes aspera) Ganiyari (Clerodendrum plomidis) Somlata (Sarcostemma acidum) Basak (Adhatoda vasica) Pudina (Mentha sylvestris)"]
// ];

// $faqs = [
//     []
// ];
// $item_code = "1010";

// // $query = "INSERT INTO `medicines` VALUES ('',NOW(),'$cat','','','" . serialize($def) . "','$off_price','$price','$dis','" . serialize($weight) . "','$quantity','$expiry','','','','" . serialize($how_use) . "','" . serialize($safety) . "','" . serialize($other_info) . "','','$item_code')";
// $query = "INSERT INTO `medicines` VALUES ('',NOW(),'$cat','" . serialize($item_img) . "','$name','$def','$off_price','$price','$dis','$weight','$quantity','$expiry','" . serialize($des_img) . "','" . serialize($des) . "','" . serialize($benefit) . "','" . serialize($how_use) . "','" . serialize($safety) . "','" . serialize($other_info) . "','" . serialize($faqs) . "','$item_code')";
// $insert = $conn->prepare($query);
// $insert->execute();

// for ($i = 1000; $i < 1024; $i++) {
//     $up = $conn->prepare("UPDATE `products` SET `item_code`='$i' WHERE `item_code`='p$i'");
//     // $up->execute();

//     
// }


$sel = $conn->prepare("SELECT * FROM `medicines`");
$sel->execute();
$sel = $sel->fetchAll();

$i = 1024;
$in = $conn->prepare("INSERT INTO `products` (`time`, `category`,`item_img`,`name`,`definition`,`offer_price`,`price`,`discount`,`weight`,`quantity`,`expiry`,`desc_img`,`description`,`benefits`,`how_use`,`safety`,`other_info`,`faqs`,`delivery_date`,`item_code`)
SELECT `time`, `category`,`item_img`,`name`,`definition`,`offer_price`,`price`,`discount`,`weight`,`quantity`,`expiry`,`desc_img`,`description`,`benefits`,`how_use`,`safety`,`other_info`,`faqs`,`delivery_date`,`item_code`
FROM `medicines`");
// $in->execute();
echo "<script>
               alert('Item Code: $i');
               </script>";

// foreach ($sel as $row) {
//     $up = $conn->prepare("UPDATE `products` SET `description`=''");

//     $time = $row["time"];
//     $cat = $row["category"];
//     $img = $row["item_img"];
//     $name = $row["name"];
//     $def = $row["definition"];
//     $off = $row["offer_price"];
//     $price = $row["price"];
//     $dis = $row["discount"];
//     $weight = $row["weight"];
//     $ex = $row["expiry"];
//     // $des_img = $row["desc_img"];
//     $des = $row["description"];
//     $ben = $row["benefits"];
//     $how = $row["how_use"];
//     $safe = $row["safety"];
//     $other = $row["other_info"];
//     $faqs = $row["faqs"];
//     $del_date = $row["delivery_date"];

//     // $in = $conn->prepare("INSERT INTO `products` VALUES('$time','$cat','$img','$name','$def','$off','$price','$dis','$weight','10','','$des','','','','$ex','$ben','$how','$safe','$other','$faqs','$del_date','$i','medicine')");

//     $i++;
// }


//! Date & Time
// $sel = $conn->prepare("SELECT * FROM `orders`");
// $sel->execute();
// $sel = $sel->fetchAll();
// foreach ($sel as $r) {
//     date_default_timezone_set('Asia/Calcutta');
//     $t = strtotime($r["time"]);
//     echo "<h1>" . date("D M, Y h:i:s", $t) . "</h1>";
// }
?>