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

$cat = "Vitamins";
$cat_img = "vitamins.jpeg";
$item_img = [
    "Revital H Capsule - Men 30s(1).jpg",
    "Revital H Capsule - Men 30s(2).jpg",
    "Revital H Capsule - Men 30s(3).jpg",
    "Revital H Capsule - Men 30s(4).jpg",
    "Revital H Capsule - Men 30s(5).jpg",
];
$name = "Revital H Capsule - Men 30s";
$def = "evital H Multivitamin For Men (30 Capsules) With Natural Ginseng, Zinc, 10 Vitamins & 8 Minerals For Daily Energy, Stamina & Immunity";
$off_price = 254.10;
$price = 330;
$dis = 23;
$weight = "50 gm";
$expiry = "Dec 2025";

$des_img = [
    "Revital H Capsule - Men 30s(1).jpg",
    "Revital H Capsule - Men 30s(2).jpg",
    "Revital H Capsule - Men 30s(3).jpg",
    "Revital H Capsule - Men 30s(4).jpg",
    "Revital H Capsule - Men 30s(5).jpg"
];

$des = [
    ["Revital H multivitamin capsules for daily health is a balanced combination of Natural Ginseng, 10 Vitamins and 9 minerals which can help fill in nutritional gaps and support general well-being for a healthy, active lifestyle"],
    ["Its key ingredients, Natural Ginseng, Vitamin B Complex and Iron, help support daily energy needs, and fight tiredness throughout the day"],
    ["Daily essential vitamins, multivitamins and minerals such as vitamin C, vitamin D and Zinc help in improving immunity preventing frequent illness"],
    ["Natural Ginseng and Magnesium, improve mental alertness and concentration, and increase the ability to manage stress"],
    ["How to Use: 1 capsule daily with a glass of water/milk/juice"],
    ["Boosts Energy, Improves Stamina and Supports Immunity"],
    ["Ingredients","Vitamin A, B1, B2, B3, B6, B12, C, D and E, Folic Acid, Calcium, Phosphorous, Zinc, Iron, Magnesium, Potassium, Manganese, Copper, Iodine, Blend of Ginseng Root Extract"]
];
$benefit = [
    ["Centrum is Worlds no. 1 Multivitamin and Multimineral brand that is present globally across 7 continents and is now in India. Centrum Men is a daily nutritional supplement, to meet your modern-day nutrition needs so you can feel confident that your body can keep up with your demanding multi-life. Your daily supplement is formulated with 23 essential Vitamins and Minerals. Centrum formulations have been tailormade for Indian diets & body needs. Its comprehensive formula ensures overall health. The Immune support nutrients such as Vitamin C and Zinc enhances Immunity and helps in fighting off infections. The formulation contains blend of B Vitamins, Calcium and Magnesium that ensures muscle performance and also helps in strengthening of bones. Centrum Men is fortified with Botanical Blend of Grape Seed Extract to ensure healthy heart. Centrum Tablets are 100% vegetarian & suitable to consume for Vegans as well. These are Gluten free tablets with Non GMO. Do not worry, they are non habit forming. Centrum Multivitamin supplements are manufactured in a FSSAI certified facility that is GMP certified. Centrum is completely FSSAI Compliant. You can refer pack for correct dosage and administration, or can consult your health care practioner. For storage condition please refer the pack."]
];
$how_use = [
    []
];
$safety = [
    ["Store in a dry place away from heat and sunlight. Read the bottle label carefully before using it. Do not exceed the daily dosage limit, and take the capsule under your doctor’s supervision. Keep away from children."]
];
$other_info = [
    []
];

$faqs = [
    []
];

$delivery_date = '2024-12-30';
$product_id = "1045";

$in = $conn->prepare("INSERT INTO `products` VALUES(NOW(), '$cat','$cat_img','" . serialize($item_img) . "','$name','$def','$off_price','$price','$dis','$weight','10','" . serialize($des_img) . "','" . serialize($des) . "','','','','$expiry','" . serialize($benefit) . "','" . serialize($how_use) . "','" . serialize($safety) . "','" . serialize($other_info) . "','" . serialize($faqs) . "','$delivery_date','$product_id','medicine')");
// $in->execute();

echo "<script>
alert('Product ID: $product_id');
</script>";


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