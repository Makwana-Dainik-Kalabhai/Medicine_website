<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_POST["payment_type"]) && $_POST["payment_type"] == "Cash On Delivery") {

    class Data
    {
        public $order_id;
        public $name;
        public $email;
        public $phone;
        public $item_code;
        public $payment_type;
        public $payment_status;
        public $status;
        public $total;
        public $del_address;
        public $del_date;

        function setValues()
        {
            $this->order_id = $_POST["order_id"];
            $this->name = $_POST["name"];
            $this->email = $_POST["email"];
            $this->phone = $_POST["phone"];
            $this->item_code = $_POST["item_code"];
            $this->payment_type = $_POST["payment_type"];
            $this->payment_status = "Cash On Delivery";
            $this->status = "Processing";
            $this->total = $_POST["total"];
            $this->del_address = $_POST["delivery_address"];
            $this->del_date = $_POST["delivery_date"];
        }

        function insertValues()
        {
            global $conn;

            if (isset($_POST["item_code"][2])) {
                $in = $conn->prepare("INSERT INTO `orders` VALUES('" . $this->order_id . "','" . $this->name . "','" . $this->email . "','" . $this->phone . "','" . serialize($this->item_code) . "',NOW(),'Cash On Delivery','Pending','Processing','" . $this->total . "','" . serialize($this->del_address) . "','" . $this->del_date . "')");
                $in->execute();
            } else {
                $in = $conn->prepare("INSERT INTO `orders` VALUES('" . $this->order_id . "','" . $this->name . "','" . $this->email . "','" . $this->phone . "','" . $this->item_code . "',NOW(),'Cash On Delivery','Pending','Processing','" . $this->total . "','" . serialize($this->del_address) . "','" . $this->del_date . "')");
                $in->execute();
            }
        }
    }

    $data = new Data();
    $data->setValues();
    $data->insertValues();
}
