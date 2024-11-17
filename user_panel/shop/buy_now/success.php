<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_POST["payment_type"])) {

    class Data
    {
        public $order_id;
        public $name;
        public $email;
        public $phone;
        public $items;
        public $off_price;
        public $price;
        public $quantity;
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
            $this->items = $_POST["items"];
            $this->off_price = $_POST["offer_price"];
            $this->price = $_POST["price"];
            $this->quantity = $_POST["quantity"];
            $this->payment_type = $_POST["payment_type"];
            $this->payment_status = $_POST["payment_status"];
            $this->status = "Processing";
            $this->total = $_POST["total"];
            $this->del_address = $_POST["delivery_address"];
            $this->del_date = date("Y-m-d 00:00:00.000000", $_POST["delivery_date"]);
        }

        function insertValues()
        {
            global $conn;

            if (isset($_POST["items"][2])) {
                $in = $conn->prepare("INSERT INTO `orders` VALUES('" . $this->order_id . "','" . $this->name . "','" . $this->email . "','" . $this->phone . "','" . serialize($this->items) . "','" . serialize($this->off_price) . "','" . serialize($this->price) . "','" . serialize($this->quantity) . "',NOW(),'" . $this->payment_type . "','" . $this->payment_status . "','" . $this->status . "','" . $this->total . "','" . serialize($this->del_address) . "','" . $this->del_date . "')");
                $in->execute();
            } else {
                $in = $conn->prepare("INSERT INTO `orders` VALUES('" . $this->order_id . "','" . $this->name . "','" . $this->email . "','" . $this->phone . "','" . serialize($this->items) . "','" . serialize($this->off_price) . "','" . serialize($this->price) . "','" . serialize($this->quantity) . "',NOW(),'" . $this->payment_type . "','" . $this->payment_status . "','" . $this->status . "','" . $this->total . "','" . serialize($this->del_address) . "','" . $this->del_date . "')");
                $in->execute();
            }
        }
    }

    $data = new Data();
    $data->setValues();
    $data->insertValues();
}