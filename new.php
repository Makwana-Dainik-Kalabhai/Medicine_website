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
$item_img = array(
    "Krishnas Herbal & Ayurveda Diabic Care Juice 1000 ml(1).jpg",
    "Krishnas Herbal & Ayurveda Diabic Care Juice 1000 ml(2).jpg",
    "Krishnas Herbal & Ayurveda Diabic Care Juice 1000 ml(3).jpg",
    "Krishnas Herbal & Ayurveda Diabic Care Juice 1000 ml(4).jpg",
    "Krishnas Herbal & Ayurveda Diabic Care Juice 1000 ml(5).jpg",
    "Krishnas Herbal & Ayurveda Diabic Care Juice 1000 ml(6).jpg",
    "Krishnas Herbal & Ayurveda Diabic Care Juice 1000 ml(7).jpg",
    "Krishnas Herbal & Ayurveda Diabic Care Juice 1000 ml(8).jpg",
    "Krishnas Herbal & Ayurveda Diabic Care Juice 1000 ml(9).jpg"
);
$name = "Krishnas Herbal & Ayurveda Diabic Care Juice 1000 ml";
$def = "The raw and pure herbs used in Krishnas Herbal & Ayurveda Diabic Care Juice are collected from reputable farms all across the country. These effective herbs assist in maintaining health sugar levels. We have multiple ayurvedic products to improve the quality of life.Blend of 11 herbs Methi, Amla, Karela, Jamun, Kutki, Guduchi & 5 other herbs to manage sugar level";
$off_price = 490;
$price = 490;
$dis = 0;
$weight = [
    "1000ml"
];
$quantity = 10;
$expiry = "Jul 2025";

$des_img = ["Krishnas Herbal & Ayurveda Diabic Care Juice 1000 ml.webp"];

$des = [
    ["The raw and pure herbs used in Krishnas Herbal & Ayurveda Diabic Care Juice are collected from reputable farms all across the country. These effective herbs assist in maintaining health sugar levels. We have multiple ayurvedic products to improve the quality of life."]
];
$benefit = [
    ["Blood sugar regulation","Diabic Care Juice is formulated to regulate blood sugar levels. With its unique blend of ingredients, this juice helps maintain proper glucose levels, providing potential benefits for individuals with diabetes."],
    ["Antioxidant support","This powerful antioxidant supplement provides support for your bodys natural defense against free radicals. With a proprietary blend of ingredients, it helps protect against oxidative stress and manage overall wellness."],
    ["Heart health","Diabic care juices, may help support heart health by manage cholesterol levels, improving blood circulation, and reducing inflammation in the arteries."],
    ["Digestive health","This Juice is a powerful solution for manage digestive health. With its unique formulation, this juice offers a natural and effective way to support the digestive system, leading to improved overall wellbeing."],
    ["Weight management","This Ayurvedic  formulated juice that helps with weight management. With its unique blend of ingredients, this juice manage healthy weight loss and management."],
    ["Hydration","Diabic Care Juice provides optimal hydration to keep you healthy and energized. Its unique formula nourishes your body and provides essential electrolytes for improved overall wellness."],
    ["Boost Metabolism","This juice can help improve your bodys metabolic rate, allowing you to feel energized and refreshed."]
];
$how_use = [
    ["Shake well before use",],
    ["Mix 30ml of juice with 30ml of warm water",],
    ["Take an empty stomach in the morning and 30 mins post-dinner",],
    ["Keep in a cold & dry place",],
    ["Close the bottle tightly",],
    ["Consume within 1 month after opening"]
];
$safety = [];
$other_info = [
    ["Jamun", "Regulates Blood sugar levels"],
    ["GILOY", "Balances the Tridoshas Vata - Pitta - Kapha"],
    ["BEL PATRA", "Strengthens Urinary system"],
    ["VIJAYSAR", "Strengthens pancreas and insulin secretion"],
    ["AMLA", "Enriched with Vitamin C"],
    ["TULSI", "Supports respiratory system"],
    ["METHI", "Strengthens nervous system"],
    ["GUDMAAR", "Liver Stimulant"],
    ["KARELA", "Enhances Insulin Secretion"],
    ["NEEM", "Natural finest detoxifier"],
    ["KUTKI", "Keeps a check on sugar levels"]
];

$faqs = [
    ["How to use?", "Take 30 ml of juice with 30 ml warm water, twice a day. Empty stomach in Morning & 30 minutes post-dinner at night. Shake well before use."],
    ["How much time it will take to control diabetes?", "You will be able to see noticeable results in 60-90 days. For best results it is advised to continue drinking this juice daily"],
    ["Can I use allopathic medicine while using diabic care juice?", "Yes, Diabic care juice is safe to be taken along with Allopathic medication. But please take 10-15 minutes gap between juice and allopathic medicine for better results."],
    ["Can use it during pregnancy ?", "Consult with your doctor before taking this in case of pregnancy. You can also connect us for free expert doctor consultation by Krishna Ayurveda."],
    ["Can a breastfeeding mom take it?", "Consult with your doctor before taking this in case of pregnancy. You can also connect us for free expert doctor consultation by Krishna Ayurveda."],
    ["What are the precautions?", "Avoid sweets, sugary foods, junk food, non-veg, rice and potatoes.Fruits which have high sugar content must be avoided (Apple and papaya can be taken). Daily 15 min exercise or walk will be very beneficial."],
    ["Whats the age criteria?", "Kids aged 10 years+ can take this juice – 15 ml twice a day. Adults can take 30ml twice a day ."],
    ["Arethere any side-effects?", "Krishnas Diabic care Juice is an ayurvedic product, the ingredients used in this juice have shown to have no side effects. However, please read the ingredients list for any known allergies."],
    ["How many days will Diabic care juice 1000ml last?", "One bottle Diabic care juice 1000ml will last for 15 days. Please order your next bottle in advance to make sure that you need not discontinue it."]
];
$item_code = "1003";

// $query = "INSERT INTO `medicines` VALUES ('',NOW(),'$cat','','','" . serialize($def) . "','$off_price','$price','$dis','" . serialize($weight) . "','$quantity','$expiry','','','','" . serialize($how_use) . "','" . serialize($safety) . "','" . serialize($other_info) . "','','$item_code')";
$query = "INSERT INTO `medicines` VALUES ('',NOW(),'$cat','" . serialize($item_img) . "','$name','" . serialize($def) . "','$off_price','$price','$dis','" . serialize($weight) . "','$quantity','$expiry','" . serialize($des_img) . "','" . serialize($des) . "','" . serialize($benefit) . "','" . serialize($how_use) . "','" . serialize($safety) . "','" . serialize($other_info) . "','" . serialize($faqs) . "','$item_code')";
$insert = $conn->prepare($query);
// $insert->execute();

$up = $conn->prepare("UPDATE `medicines` SET `definition`='$def' WHERE item_code='1003'");
// $up->execute();

// echo "<script>
//        alert('Inserted successfully');
//        </script>";

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