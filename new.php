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

$cat = "ayurvedic";
$item_img = [
    "Chyawanprash Preservative Free(1).webp",
    "Chyawanprash Preservative Free(2).webp",
    "Chyawanprash Preservative Free(3).webp",
    "Chyawanprash Preservative Free(4).webp",
    "Chyawanprash Preservative Free(5).webp"
];
$name = "Chyawanprash Preservative Free";
$def = "Made using only fresh amla, A2 Ghee & cold pressed sesame oil in Glass Bottle | Ayurvedic Immunity Booster | Support For All Age Groups | All Season";
$off_price = 428;
$price = 490;
$dis = 14;
$weight = "500g";
$quantity = 10;
$expiry = "";

$des_img = ["Chyawanprash Preservative Free.webp"];

$des = [
    ["Krishnas Chyawanprash Preservative Free is power-packed with fresh Amla, rich in Vitamin C and more than 45 essential herbs and minerals. It is made with A2 desi cow ghee in an iron pan in small batches using original Vanshlochan & All Herbs. This Chywawanprash benefits all age groups and follows the formula in ancient scriptures."],
    ["Krishnas Chyawanprash uses fresh Amla fruits (cold-pressed) to unlock the high antioxidant value and get the true benefit of Vitamin C. Chyawanprash ingredients are Vanshlochan, Till Oil, and more than 45 raw herbs. This Chywanprash uses the classical Ayurvedic process known as the Shasktot Process. Experience the benefits of the traditional herbal supplement for generations."]
];
$benefit = [
    ["Natural Protection", "Builds Healthy living against common allergies and health probs and is suitable for all age groups. "],
    ["Improves Memory", "Possesses properties to improve memory function."],
    ["Enriched with Vitamin C", "Amla is rich in antioxidants and has abundant Vitamin C."],
    ["Packaging and Safety", "Krishnas Chyawanprash does not use harmful metals which can cause toxicity and has no artificial flavors or colors. The packaging consists of glass bottles to avoid the leaching of harmful chemicals in the product for enhanced safety."]
];
$how_use = [
    ["For Adults", "1 teaspoon twice daily"],
    ["For children above two years", "1/2 teaspoon twice daily. Follow with warm milk for best results, but can be consumed directly."],
    ["This product is natural; therefore, the color & taste may change slightly from batch to batch due to seasonal variations without affecting purity, efficiency & quality as all ingredients are natural."]
];
$safety = [
];
$other_info = [
    []
];

$faqs = [
    []
];
$item_code = "1005";

// $query = "INSERT INTO `medicines` VALUES ('',NOW(),'$cat','','','" . serialize($def) . "','$off_price','$price','$dis','" . serialize($weight) . "','$quantity','$expiry','','','','" . serialize($how_use) . "','" . serialize($safety) . "','" . serialize($other_info) . "','','$item_code')";
$query = "INSERT INTO `medicines` VALUES ('',NOW(),'$cat','" . serialize($item_img) . "','$name','" . serialize($def) . "','$off_price','$price','$dis','" . serialize($weight) . "','$quantity','$expiry','" . serialize($des_img) . "','" . serialize($des) . "','" . serialize($benefit) . "','" . serialize($how_use) . "','" . serialize($safety) . "','" . serialize($other_info) . "','" . serialize($faqs) . "','$item_code')";
$insert = $conn->prepare($query);
// $insert->execute();

$up = $conn->prepare("UPDATE `medicines` SET `definition`='$def' WHERE item_code='1003'");
// $up->execute();

echo "<script>
       alert('Inserted successfully');
       </script>";

// $img =[
//     "Invacare Platinum 9 LPM(1).jpg",
//     "Invacare Platinum 9 LPM(2).jpg",
//     "Invacare Platinum 9 LPM(3).jpg"
// ];


// $sel = $conn->prepare("SELECT `name` FROM `products` WHERE `name` LIKE '%5L%'");
// $sel = $conn->prepare("SELECT * FROM `products`");
// $sel->execute();
// $sel = $sel->fetchAll();

// foreach($sel as $row) {
//     echo "<h1>".$row["name"]."</h1>";
// }
// foreach($sel as $row) {
//     echo "<h1>Description:- </h1>";
//     $desc = unserialize($row["description"]);
//     foreach ($desc as $des) {
//         echo "<p>$des</p>";
//     }
//     echo "<hr>";
//     echo "<h1>Features:- </h1>";
//     $features = unserialize($row["feature1"]);
//     foreach ($features as $fea) {
//         echo "<li>$fea</li>";
//     }

//     echo "<hr>";
//     echo "<h1>Specification:- </h1>";
//     $spes = unserialize($row["specification1"]);
?>

<!-- <table>
    <?php foreach ($spes as $spe) { ?>
        <tr>
        <?php //foreach($spe as $sp) { 
        ?>
        <th><?php echo $spe[0]; ?></th>
        <td><?php echo $spe[1]; ?></td>
        <?php } ?>
        </tr>
    <?php //} 
    ?>
    </table>
<?php //} 
?> -->