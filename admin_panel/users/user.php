<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <title>User's List</title>
  <link rel="stylesheet" href="http://localhost/php/medicine_website/admin_panel/users/user.css" />
  <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php");
  ?>
</head>

<script>
  $(document).ready(() => {
    $(".user-list").DataTable();

    $(".active-btn").click(function() {
      let email = $(this).val();

      $.ajax({
        type: "POST",
        url: "http://localhost/php/medicine_website/admin_panel/users/user.php",
        data: {
          email: email,
          status: "Active"
        },
        success: function(data) {
          window.location.reload();
        }
      });
    });
    $(".block-btn").click(function() {
      let email = $(this).val();

      $.ajax({
        type: "POST",
        url: "http://localhost/php/medicine_website/admin_panel/users/user.php",
        data: {
          email: email,
          status: "Blocked"
        },
        success: function(data) {
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

<body>
  <iv class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/sidenav.php"); ?>
    </div>

    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Paper Dashboard 2</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-magnify" href="javascript:;">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="javascript:;">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="content">
        <div class="card">
          <div class="row">
            <span class="mx-5 py-3 text-danger">User List</span>
          </div>
        </div>
        <hr />

        <div class="card p-3">
          <table class="user-list">
            <thead class="bg-danger text-light">
              <tr>
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

              foreach ($sel_user as $r_user) { ?>
                <tr>
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
                  <td class="col-md-3"><?php
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

                      <button class="btn btn-dark block-btn" value="<?php echo $r_user["email"]; ?>">Block</button>
                    </td>
                  <?php } else { ?>
                    <td class="col-md-1 text-danger fw-bolder"><?php echo $r_user["status"]; ?>&emsp;
                      <button class="btn btn-success active-btn" value="<?php echo $r_user["email"]; ?>">Active</button>
                    </td>
                  <?php } ?>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <footer class="footer footer-black  footer-white ">
        <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/footer.php"); ?>
      </footer>
    </div>
    </div>
</body>

</html>