<style>
    img {
        mix-blend-mode: multiply !important;
    }
    .btn-group {
        width: 100% !important;
        height: 100% !important;
    }

    .btn-group button {
        position: relative;
    }

    .btn-group span {
        position: absolute;
        right: 15%;
        font-size: 17px;
        padding: 2.5% 3.5%;
        color: white;
        background-color: red;
        margin-left: 2%;
        border-radius: 10px;
    }

    .btn-group ul {
        width: 100% !important;
    }

    .btn-group li:hover {
        background-color: transparent !important;
    }

    .btn-group li a:hover i {
        color: white !important;
    }

    .dropdown-toggle {
        display: flex !important;
        align-items: center !important;
        background-color: transparent !important;
    }

    .dropdown-toggle:hover i {
        color: white !important;
    }

    .dropdown-toggle:focus i {
        color: white !important;
    }
</style>

<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a class="simple-text logo-mini">
            <div class="logo-image-big">
                <img src="http://localhost/php/medicine_website/admin_panel/admin.png" type="image/x-icon" />
            </div>
        </a>
        <a class="simple-text logo-normal">
            Admin Panel
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li>
                <a href="http://localhost/php/medicine_website/admin_panel/index.php">
                    <i class="fa-solid fa-user"></i>
                    <p>Users</p>
                </a>
            </li>

            <?php
            $orders = $conn->prepare("SELECT * FROM `orders` WHERE `status`='Processing'");
            $orders->execute();
            $orders = $orders->fetchAll();
            $total = 0;

            foreach ($orders as $o) {
                $total++;
            }
            ?>
            <div class="btn-group">
                <button class="btn text-danger dropdown-toggle border-bottom" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-shopping-bag text-danger"></i>
                    Orders <?php echo ($total > 0) ? "<span>$total</span>" : ""; ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="http://localhost/php/medicine_website/admin_panel/orders/processing.php" class="dropdown-item" type="button">
                            Processing Orders
                        </a>
                    </li>
                    <li>
                        <a href="http://localhost/php/medicine_website/admin_panel/orders/shipped.php" class="dropdown-item" type="button">
                            Shipped Orders
                        </a>
                    </li>
                    <li>
                        <a href="http://localhost/php/medicine_website/admin_panel/orders/cancelled.php" class="dropdown-item" type="button">
                            Cancelled Orders
                        </a>
                    </li>
                </ul>
            </div>

            <div class="btn-group">
                <button class="btn text-danger dropdown-toggle border-bottom" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-list text-danger"></i>
                    Products
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="http://localhost/php/medicine_website/admin_panel/products/medicine_list.php" class="dropdown-item" type="button">
                            <i class="fa-solid fa-tablets"></i> Medicines
                        </a>
                    </li>
                    <li>
                        <a href="http://localhost/php/medicine_website/admin_panel/products/device_list.php" class="dropdown-item" type="button">
                            <i class="fa-solid fa-list"></i> Medical Devices
                        </a>
                    </li>
                </ul>
            </div>
            <div class="btn-group">
                <button type="button" class="btn text-danger dropdown-toggle border-bottom" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-star text-danger"></i>
                    Ratings / Reviews
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="http://localhost/php/medicine_website/admin_panel/ratings/medicine_list.php" class="dropdown-item" type="button">
                            <i class="fa-solid fa-tablets"></i> Medicines
                        </a>
                    </li>
                    <li>
                        <a href="http://localhost/php/medicine_website/admin_panel/ratings/device_list.php" class="dropdown-item" type="button">
                            <i class="fa-solid fa-list"></i> Medical Devices
                        </a>
                    </li>
                </ul>
            </div>
        </ul>
    </div>
</div>