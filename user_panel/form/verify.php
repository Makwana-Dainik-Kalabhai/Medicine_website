<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");

// This is for signUp Form
if (isset($_POST["sign_submit"])) {


    class User
    {
        public $user = array();
        public string $profile_img;
        public string $name;
        public $gender;
        public $age;
        public $email;
        public $pass;
        public $phone;
        public $address;
        public $status;

        function setValue($name, $email, $pass)
        {
            $this->profile_img = "";
            $this->name = $name;
            $this->gender = "";
            $this->age = 0;
            $this->email = $email;
            $this->pass = $pass;
            $this->phone = 0;
            $this->address = "";
            $this->status = "Active";
        }

        function insertValue()
        {
            global $conn;
            $insert = $conn->prepare("INSERT INTO `user_login_data` VALUES ('" . $this->profile_img . "','" . $this->name . "','" . $this->gender . "','" . $this->age . "','" . $this->email . "','" . $this->pass . "','" . $this->phone . "','" . $this->address . "','" . $this->status . "')");
            $insert->execute();
        }
    }

    $contain_email = "";

    $sel_email = $conn->prepare("SELECT email FROM `user_login_data` WHERE email='" . $_POST["sign_email"] . "'");
    $sel_email->execute();
    $sel_email = $sel_email->fetchAll();

    foreach ($sel_email as $row) {
        $contain_email = $row["email"];
    }

    if ($contain_email != $_POST["sign_email"]) {

        $U = new User();
        //! Set values of user
        $U->setValue($_POST["sign_name"], $_POST["sign_email"], $_POST["sign_pass"]);

        //! Insert it into database.
        $U->insertValue();

        $select = $conn->prepare("SELECT * FROM `user_login_data` WHERE email='" . $_POST["sign_email"] . "'");
        $select->execute();
        $select = $select->fetchAll();

        foreach ($select as $row) {
            $_SESSION["email"] = $row["email"];
        }

        $_SESSION["form_succ"] = "signUp Successfully";
        header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/form/sign_form.php");

        //
    } else {
        $_SESSION["form_error"] = "Email Id is already Exist";
        header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/form/sign_form.php");

        //
    }
}









// This is for Login Form
if (isset($_POST["login_submit"])) {

    $login_email = $_POST["login_email"];
    $login_pass = $_POST["login_pass"];

    if($_SESSION["max_try"] >= 3) {
        $_SESSION["form_error"] = "You can try after 1 hour";
        header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/form/login_form.php");
        return;
    }
    
    
    $sel_admin = $conn->prepare("SELECT * FROM `admin_login_data`");
    $sel_admin->execute();
    $sel_admin = $sel_admin->fetchAll();

    foreach ($sel_admin as $row_admin) {
        if ($login_email == $row_admin["email"] && $login_pass == $row_admin["pass"]) {
            $contain_admin = true;
            $_SESSION["admin_email"] = $row_admin["email"];
        }
    }
    
    $sel_user = $conn->prepare("SELECT * FROM `user_login_data`");
    $sel_user->execute();
    $sel_user = $sel_user->fetchAll();
    
    foreach ($sel_user as $row_user) {
        if ($login_email == $row_user["email"] && $login_pass == $row_user["pass"]) {
            $contain_user = true;
            $_SESSION["email"] = $row_admin["email"];
        }
    }
    
    // ! if Email id exist in admin_login_data & user_login_data
    if (isset($contain_admin) && isset($contain_user)) {
        
        $_SESSION["admin_user"] = true;
        header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/form/login_form.php");
        return;
    }
    
    foreach ($sel_admin as $row_admin) {

        if ($login_email == $row_admin["email"] && $login_pass == $row_admin["pass"]) {

            $_SESSION["admin_email"] = $row_admin["email"];
            
            header("Refresh:0; url='http://localhost/php/medicine_website/admin_panel/index.php'");
            return;
        }
        //
        if ($login_email == $row_admin["email"] && $login_pass != $row_admin["pass"]) {
            $_SESSION["form_error"] = "Invalid Password";
            $max_try = true;
            
            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/form/login_form.php");
        }
        //
        else {
            $_SESSION["form_error"] = "Invalid Email ID";
            $max_try = true;
            
            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/form/login_form.php");
        }
    }
    
    foreach ($sel_user as $row_user) {
        if ($login_email == $row_user["email"] && $login_pass == $row_user["pass"]) {
            
            $contain_user = true;
            $_SESSION["email"] = $row_user["email"];
            $_SESSION["form_succ"] = "Login Successfully";

            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/form/login_form.php");
            return;
        }
        //
        if ($login_email == $row_user["email"] && $login_pass != $row_user["pass"]) {
            $_SESSION["form_error"] = "Invalid Password";
            $max_try = true;

            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/form/login_form.php");
        }
        //
        else {
            $_SESSION["form_error"] = "Invalid Email ID";
            $max_try = true;
            
            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/form/login_form.php");
        }
    }
    
    if (isset($max_try) && $_SESSION["max_try"]<=3) {
        $_SESSION["time"] = time()+3600;
        $_SESSION["max_try"]++;
    }
}


//! If email is exist in admin & user
if (isset($_GET["admin"])) {
    unset($_SESSION["admin_user"]);
    
    header("Refresh:0; url='http://localhost/php/medicine_website/admin_panel/index.php'");
    return;
}
//
if (isset($_GET["user"])) {
    unset($_SESSION["admin_user"]);

    header("Refresh:0; url='http://localhost/php/medicine_website/index.php'");
    return;
}
