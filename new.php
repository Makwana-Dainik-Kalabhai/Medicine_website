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
    "Truuth Ashwagandha 500mg Capsule 60s(1).jpg",
    "Truuth Ashwagandha 500mg Capsule 60s(2).jpg",
    "Truuth Ashwagandha 500mg Capsule 60s(3).jpg",
    "Truuth Ashwagandha 500mg Capsule 60s(4).jpg",
    "Truuth Ashwagandha 500mg Capsule 60s(5).jpg"
];
$name = "Truuth Ashwagandha 500mg Capsule 60's";
$def = [];
$off_price = 239.60;
$price = 599;
$dis = 60;
$weight = [
    "150gm"
];
$quantity = 10;
$expiry = "Jul 2025";

$des = [
    ["Truuth Ashwagandha Capsules, available in a pack of 60, introduce you to the age-old wisdom of Ayurveda in a modern and convenient form."],
    ["Each capsule encapsulates 500mg of pure Ashwagandha extract, delivering a potent and standardized dose of this revered herb."],
    ["Ashwagandha, known for its adaptogenic properties, is a versatile herb that has been traditionally used to support the body in managing stress, enhancing vitality, and promoting an overall sense of well-being."],
    ["Crafted with precision and care, Truuth Ashwagandha Capsules provide you with a natural way to elevate your health."],
    ["The 60-capsule pack ensures a sustained supply, allowing you to effortlessly incorporate this Ayurvedic gem into your daily routine."],
    ["Whether you are navigating the challenges of a hectic lifestyle or seeking a holistic approach to your well-being journey, Truuth Ashwagandha Capsules stand as your reliable companion, offering the goodness of nature in every dose."]
];
$benefit = [
    "With 500mg of pure Ashwagandha extract per capsule, this supplement ensures a concentrated and effective dose.",
    "The 60-capsule pack facilitates a seamless integration of Ashwagandha into your daily health routine, supporting a holistic approach to well-being.",
    "Ashwagandha is renowned for its adaptogenic qualities, assisting the body in adapting to stressors and promoting balance."
];
$how_use = [
    ["ncorporate the capsule into your daily routine consistently."],
    ["Ensure proper hydration by drinking enough water when taking the capsule."],
    ["If you have underlying health conditions or are on medication, consult with a healthcare professional before use."]
];
$safety = [
    "Truuth Ashwagandha 500mg Capsules are generally safe for consumption when used as directed.",
    "However, individuals with specific medical conditions, pregnant or lactating women, and those under other medications should consult with a healthcare professional before incorporating this supplement into their routine.",
    "While Ashwagandha is well-tolerated by many, potential interactions with certain medications may exist.",
    "It is advisable to start with the recommended dosage and monitor individual responses.",
    "In case of any adverse reactions or allergies, discontinue use and seek professional advice."
];
$other_info = [[
    "Store in a cool, dry place, away from direct sunlight, and keep it out of reach of children."
]];

$faqs = [
    ["Are there any known side effects of Ashwagandha capsules?","Ashwagandha is generally well-tolerated, but individuals with specific medical conditions should consult with a healthcare professional before use."],
    ["How long does it take to experience the benefits of Ashwagandha?","Individual responses may vary, but consistent use over a few weeks is typically recommended for noticeable effects."],
    ["Is Truuth Ashwagandha safe for daily use?","Yes, Truuth Ashwagandha Capsules are formulated for daily use; however, individuals with specific health concerns should consult a healthcare professional."]
];
$item_code = "m1002";

$query = "INSERT INTO `medicines` VALUES ('',NOW(),'$cat','','','" . serialize($def) . "','$off_price','$price','$dis','" . serialize($weight) . "','$quantity','$expiry','','" . serialize($benefit) . "','" . serialize($how_use) . "','" . serialize($safety) . "','" . serialize($other_info) . "','".serialize($faqs)."','$item_code')";
$insert = $conn->prepare($query);
// $insert->execute();


$up = $conn->prepare("UPDATE `medicines` SET `description`='".serialize($des)."' WHERE `item_code`='m1002'");
// $up->execute();

// $sel = $conn->prepare("SELECT SUBSTRING(`item_code`,2,length(item_code)) FROM `products`");
// $sel->execute();
// $sel = $sel->fetchAll();

// print_r($sel);
// foreach($sel as $row) {
//     echo $row["item_code"]."<br/>";
// }
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