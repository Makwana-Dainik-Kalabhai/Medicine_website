<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <title>User's List</title>
  <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

<style>
  .profile-img {
    display: block;
    width: 70px;
    height: 70px;
    padding: 2%;
    margin: auto;
    border-radius: 50%;
    filter: contrast(110%);
  }
</style>


<script>
  $(document).ready(() => {
    $(".user-list").DataTable();

    $(".active-user").click(function() {
      let email = $(this).val();

      $.ajax({
        type: "POST",
        url: "http://localhost/php/medicine_website/admin_panel/index.php",
        data: {
          email: email,
          status: "Active"
        },
        success: function() {
          window.location.reload();
        }
      });
    });
    $(".block-user").click(function() {
      let email = $(this).val();

      $.ajax({
        type: "POST",
        url: "http://localhost/php/medicine_website/admin_panel/index.php",
        data: {
          email: email,
          status: "Blocked"
        },
        success: function() {
          window.location.reload();
        }
      });
    });
  });
</script>

<?php
if (isset($_POST["email"])) {
  $up = $conn->prepare("UPDATE `user_login_data` SET `status`='" . $_POST["status"] . "' WHERE `email`='" . $_POST["email"] . "'");
  $up->execute();
}
?>

<body class="">
  <div class="wrapper ">
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/sidenav.php"); ?>

    <div class="main-panel">
      <!-- Navbar -->
      <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/header/header.php"); ?>

      <div class="content">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <img src="http://localhost/php/medicine_website/admin_panel/medicines.jpg" alt="">
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Types of Medicines</p>
                      <?php
                      $med = $conn->prepare("SELECT * FROM `products` WHERE `status`='medicine'");
                      $med->execute();
                      $med = $med->fetchAll();
                      $total = 0;

                      foreach ($med as $m) {
                        $total++;
                      }
                      ?>
                      <p class="card-title"><?php echo $total; ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa-solid fa-tablets"></i>
                  Total <?php echo $total; ?> types of Medicines
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <img src="http://localhost/php/medicine_website/admin_panel/devices.png" alt="">
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Types of Devices</p>
                      <?php
                      $dev = $conn->prepare("SELECT * FROM `products` WHERE `status`='device'");
                      $dev->execute();
                      $dev = $dev->fetchAll();
                      $total = 0;

                      foreach ($dev as $d) {
                        $total++;
                      }
                      ?>
                      <p class="card-title"><?php echo $total; ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa-solid fa-list"></i>
                  Total <?php echo $total; ?> types of Medical Devices
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Revenue</p>
                      <?php
                      $orders = $conn->prepare("SELECT * FROM `orders` WHERE `status`='Shipped'");
                      $orders->execute();
                      $orders = $orders->fetchAll();
                      $total = 0;

                      foreach ($orders as $o) {
                        $total += $o["total_price"];
                      }
                      ?>
                      <p class="card-title">&#8377; <?php echo $total; ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa-solid fa-rupee"></i>
                  Total Revenue including Cost
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-favourite-28 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Users</p>
                      <?php
                      $users = $conn->prepare("SELECT * FROM `user_login_data`");
                      $users->execute();
                      $users = $users->fetchAll();
                      $total = 0;

                      foreach ($users as $u) {
                        $total++;
                      }
                      ?>
                      <p class="card-title"><?php echo $total; ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa-solid fa-user"></i>
                  Users of the HealthGroup
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- //! User's List -->
        <div class="card">
          <div class="row">
            <h6 class="mx-5 py-3 text-danger">User's List</h6>
          </div>
        </div>
        <hr />

        <div class="card p-3">
          <table class="user-list">
            <thead class="bg-danger text-light">
              <tr>
                <th class="col-md-1">Sr.No.</th>
                <th class="col-md-1">Profile</th>
                <th class="col-md-2">Name</th>
                <th class="col-md-3">Email</th>
                <th class="col-md-1">Phone</th>
                <th class="col-md-3">Address</th>
                <th class="col-md-1">Status</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $sel_user = $conn->prepare("SELECT * FROM `user_login_data`");
              $sel_user->execute();
              $sel_user = $sel_user->fetchAll();
              $i = 1;

              foreach ($sel_user as $r_user) { ?>
                <tr class="border-bottom">
                  <td class="col-md-1"><?php echo $i . ")"; ?></td>
                  <td class="col-md-1">
                    <?php
                    if ($r_user["profile_img"] != null) { ?>
                      <img class="profile-img" src="http://localhost/php/medicine_website/user_panel/profile/profile_imgs/<?php echo $r_user["profile_img"]; ?>" />
                    <?php } else { ?>
                      <img class="profile-img" src="http://localhost/php/medicine_website/user_panel/profile/user.png" />
                    <?php } ?>
                  </td>
                  <td class="col-md-2"><?php echo $r_user["name"]; ?></td>
                  <td class="col-md-3"><?php echo $r_user["email"]; ?></td>
                  <td class="col-md-1"><?php if ($r_user["phone"] != 0) {
                                          echo $r_user["phone"];
                                        } else {
                                          echo "-";
                                        } ?></td>
                  <td class="col-md-3">
                    <?php
                    if ($r_user["address"] != null && unserialize($r_user["address"])["suite"] != null) {
                      $address = unserialize($r_user["address"])["house_no"] . ", " . unserialize($r_user["address"])["street"] . " near " . unserialize($r_user["address"])["suite"] . ", " . unserialize($r_user["address"])["city"] . ", " . unserialize($r_user["address"])["state"] . " - " . unserialize($r_user["address"])["pincode"];
                    } else if ($r_user["address"] != null) {
                      $address = unserialize($r_user["address"])["house_no"] . ", " . unserialize($r_user["address"])["street"] . ", " . unserialize($r_user["address"])["city"] . ", " . unserialize($r_user["address"])["state"] . " - " . unserialize($r_user["address"])["pincode"];
                    } else {
                      $address = "-";
                    }

                    echo $address; ?></td>


                  <?php if ($r_user["status"] == "Active") { ?>
                    <td class="col-md-1 text-success fw-bolder"><?php echo $r_user["status"]; ?>&emsp;

                      <button class="btn btn-dark block-user" value="<?php echo $r_user["email"]; ?>">Block</button>
                    </td>
                  <?php } else { ?>
                    <td class="col-md-1 text-danger fw-bolder"><?php echo $r_user["status"]; ?>&emsp;
                      <button class="btn btn-success active-user" value="<?php echo $r_user["email"]; ?>">Active</button>
                    </td>
                  <?php } ?>
                </tr>
              <?php $i++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
      <footer class="footer footer-black  footer-white ">
        <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/footer/footer.php"); ?>
      </footer>
    </div>
  </div>

</body>

</html>