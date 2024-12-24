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

$cat = "Diabetes Care";
$cat_img = "diabetes care.png";
$item_img = [
    "Kapiva Dia Free Juice 1 ltr(1).jpg",
    "Kapiva Dia Free Juice 1 ltr(2).jpg",
    "Kapiva Dia Free Juice 1 ltr(3).jpg",
    "Kapiva Dia Free Juice 1 ltr(4).jpg",
    "Kapiva Dia Free Juice 1 ltr(5).jpg",
    "Kapiva Dia Free Juice 1 ltr(6).jpg",
    "Kapiva Dia Free Juice 1 ltr(7).jpg",
    "Kapiva Dia Free Juice 1 ltr(8).jpg",
    "Kapiva Dia Free Juice 1 ltr(9).jpg"
];
$name = "Kapiva Dia Free Juice 1 ltr";
$def = "Kapiva Dia Free Juice, 1L | Clinically Proven Blood Sugar Care | Amla, Karela, Jamun, Guduchi & 7 More";
$off_price = 599;
$price = 599;
$dis = 0;
$weight = "1 ltr";
$expiry = "Dec 2025";

$des_img = [
    "Kapiva Dia Free Juice 1 ltr(1).jpg",
    "Kapiva Dia Free Juice 1 ltr(2).jpg",
    "Kapiva Dia Free Juice 1 ltr(3).jpg",
    "Kapiva Dia Free Juice 1 ltr(4).jpg",
];

$des = [
    ["Kapiva Dia Free Juice, available in a generous 1-liter pack, is a carefully crafted formulation to support healthy blood sugar levels. This herbal juice combines the goodness of key ingredients such as Aloe Vera, Amla, and Gurmar, each known for its potential in promoting metabolic wellness. Aloe Vera, celebrated for its soothing properties, works in tandem with Amla, rich in antioxidants, to provide a nourishing foundation for overall well-being.Gurmar, an herb aptly named sugar destroyer, is a crucial component aimed at supporting balanced blood sugar levels. Kapiva Dia Free Juice offers a convenient and natural way to incorporate these Ayurvedic ingredients into your daily routine. Whether you are proactively managing blood sugar or seeking a holistic wellness elixir, this juice stands as a testament to Kapivas commitment to combining tradition with modern wellness needs."],
    ["SCIENCE-BACKED 11 POTENT AYURVEDIC HERBS", "Kapiva Dia Free Juice is a blend of 11 Ayurvedic herbs that help in managing uncontrolled spikes in Blood sugar levels and eases out the complications of Blood Sugar such as improper digestion, low energy, and weak immunity."],
    ["CONTROL BLOOD SUGAR LEVELS", "Herbs such as Karela, Amla, Jamun, Tulsi, Guduchi, Methi and Belpatra, optimize the production of hormones by breaking down glucose from foods. Regular consumption of this juice can help in maintaining optimal sugar levels within 3 months of consumption."],
    ["100% AYURVEDIC", "This juice does not contain any added sugar or artificial taste-enhancers. It is 100% Ayurvedic and safe to be consumed along with your regular allopathic medications."],
    ["NATURALLY SOURCED INGREDIENTS", "All ingredients are sourced from the choicest locations and mixed in the right proportions for maximum nutrition - Amla from Pratapgarh, Neem from Rajasthan, and so on. Each bottle of Dia Free Juice contains 45 Amlas, 24 Jamun Seeds, 1 Whole Karela and more - the best of herbs recommended in traditional texts to treat madhumeh."],
    ["HOW TO CONSUME", "Mix 30ml Dia Free Juice with 30ml of water and consume it twice a day for long-term health benefits. If taken in the morning, should be taken on an empty stomach. Consume regularly for 3 Months for best results."]
];
$benefit = [
    ["Gurmar, Aloe Vera, and Amla work synergistically to support healthy blood sugar levels."],
    ["Amla, a potent antioxidant, contributes to overall well-being."],
    ["Kapiva Dia Free Juice offers a convenient way to incorporate Ayurvedic ingredients into your daily routine."]
];
$how_use = [
    ["Take 30 ml (two tablespoons) of Kapiva Dia Free Juice twice a day before meals or as directed by a healthcare professional."],
    ["Adjust the dosage based on individual needs and consult with a professional for personalized advice."],
];
$safety = [
    ["Kapiva Dia Free Juice is generally safe for regular use. However, individuals with specific medical conditions, allergies, or those on medication should consult with a healthcare professional before using any new supplement. If any adverse reactions occur, discontinue use and seek professional advice."]
];
$other_info = [
    ["Keep out of reach of children and store in a cool, dry place, away from direct sunlight."]
];

$faqs = [
    ["Is Kapiva Dia Free Juice suitable for individuals with diabetes?", "Kapiva Dia Free Juice is specifically formulated to support healthy blood sugar levels. However, individuals with diabetes should consult with a healthcare professional before adding any new supplement to their routine."],
    ["Can Kapiva Dia Free Juice replace medication for diabetes?", "No, Kapiva Dia Free Juice is a supplement and not a replacement for prescribed medications. Individuals with diabetes should continue their prescribed treatment and consult with a healthcare professional before making any changes."],
    ["Are there any known side effects of Kapiva Dia Free Juice?", "The juice is generally well-tolerated, but if any adverse reactions occur, discontinue use and seek professional advice."]
];

$delivery_date = '2024-12-30';
$product_id = "1039";

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