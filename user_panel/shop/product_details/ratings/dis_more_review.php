<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

$sel = $conn->prepare("SELECT *, ratings.email FROM `ratings` INNER JOIN `user_login_data` ON ratings.email=user_login_data.email  WHERE `item_code`='" . $_SESSION["item_code"] . "' ORDER BY `time` LIMIT " . $_POST["limit"] . "");
$sel->execute();
$sel = $sel->fetchAll();
foreach ($sel as $row) {
    if ($row["email"] != $_SESSION["email"]) {
        disRev($row);
    }
}

function disRev($row)
{ ?>
    <div id="review">
        <div id="user">
            <?php if ($row["profile_img"] != null) { ?>
                <img src="http://localhost/php/medicine_website/user_panel/profile/profile_imgs/<?php echo $row["profile_img"]; ?>" alt="">
            <?php } else { ?>
                <img src="http://localhost/php/medicine_website/user_panel/profile/user.png" alt="">
            <?php } ?>
            <span><?php echo $row["name"]; ?></span>
        </div>
        <h2><?php if (isset(unserialize($row["review"])[0])) echo unserialize($row["review"])[0]; ?></h2>
        <?php
        if ($row["rate"] != 0) {
            $i = 0;
            while ($i < 5) {
                if ($i < $row["rate"]) { ?>
                    <i class="fa-solid fa-star" style="color:#ffaf1a;"></i>
                <?php }
                //
                else { ?>
                    <i class="fa-solid fa-star"></i>
        <?php }
                $i++;
            }
        } ?>
        <p><?php if (isset(unserialize($row["review"])[1])) echo unserialize($row["review"])[1]; ?></p>

        <?php
        if (isset($_SESSION["email"]) && $row["email"] == $_SESSION["email"]) { ?>
            <a href="./ratings/del_review.php"><i class="fa-solid fa-trash"></i></a>
        <?php } ?>
        <span id="time"><?php $time = strtotime($row["time"]);
                        echo date("d M, Y", $time); ?></span>
    </div>
<?php } ?>