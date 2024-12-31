<style>
    .btn-group {
        width: 100% !important;
        height: 100% !important;
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
                <a href="http://localhost/php/medicine_website/admin_panel/users/user.php">
                    <i class="fa-solid fa-user"></i>
                    <p>Users</p>
                </a>
            </li>

            <li>
                <a href="http://localhost/php/medicine_website/admin_panel/orders/orders.php">
                    <i class="fa-solid fa-shopping-bag"></i>
                    <p>Orders</p>
                </a>
            </li>

            <div class="btn-group mt-3 mb-5 pb-4">
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
            <div class="btn-group mt-5">
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