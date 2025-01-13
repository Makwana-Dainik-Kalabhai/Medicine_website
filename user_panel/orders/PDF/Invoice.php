<?php
session_start();
if (isset($_GET["order_id"])) {
    $_SESSION["order_id"] = $_GET["order_id"];
}
include("C:/xampp/htdocs/php/medicine_website/database.php");

$sel = $conn->prepare("SELECT * FROM `orders` WHERE `email`='" . $_SESSION["email"] . "' AND `order_id`='" . $_SESSION["order_id"] . "'");
$sel->execute();
$sel = $sel->fetchAll();

foreach ($sel as $row) {
    $html = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Download Invoice</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css'
    integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
    <link rel='stylesheet' href='http://localhost/php/medicine_website/user_panel/orders/PDF/Invoice.css'>
</head>

<body id='pdf'>
    <header id='header1'>
        <table>
            <tr>
                <td id='logo'>
                    <img src='http://localhost/php/medicine_website/user_panel/header/logo1.png' alt='Logo'/>
                </td>

                <td id='company_details'>
                    <span id='company'>healthGroup Pvt. Ltd.</span>
                    <span id='address'>34, Kameshwar park, opp. Swaminarayan Mandir, Hirawadi road, Saidpur bogha, Ahmedabad, Gujarat, India.</span>
                    <span id='pincode'>382345</span>
                </td>
            </tr>
        </table>
    </header>
    <hr>";

    $address = unserialize($row["delivery_address"])["house_no"] . ", " . unserialize($row["delivery_address"])["street"] . " near " . unserialize($row["delivery_address"])["suite"] . ", " . unserialize($row["delivery_address"])["pincode"] . ", " . unserialize($row["delivery_address"])["city"] . " - " . unserialize($row["delivery_address"])["state"];

    $html .= "<header id='header2'>
        <table>
            <tr>
                <td id='user_details'>
                        <span id='heading'>BILL TO:</span>
                        <span id='email'>" . $_SESSION["email"] . "</span>
                        <span id='address'>" . $address . "</span>
                </td>
                <td id='invoice_details'>
                    <span>Order ID</span>
                    <span>" . $row["order_id"] . "</span>";
    if ($row["status"] == "Processing") {
        $html .= "<span>Expected Delivery</span>";
    } else if ($row["status"] == "Shipped") {
        $html .= "<span>Delivered</span>";
    }
    $html .= "<span>" . date("M d,Y", strtotime($row["delivery_date"])) . "</span>
                    <span>Payment Type</span>
                    <span>" . $row["payment_type"] . "</span>
                </td>
            </tr>
        </table>
    </header>
    <hr>

    <main>
        <table cellspacing='0' style='border-bottom: 1.5px solid black;'>
            <thead>
                <tr>
                    <th>ITEM</th>
                    <th>PRODUCT</th>
                    <th>RATE</th>
                    <th>QUANTITY</th>
                    <th>SUB TOTAL</th>
                </tr>
            </thead>

            <tbody style='border-bottom: 1.5px solid black;'>";

    $rate = 0;
    $quantity = 0;
    $subTotal = 0;
    $count = 1;

    for ($i = 0; $i < count(unserialize($row["items"])); $i++) {
        $selPr = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . unserialize($row["items"])[$i] . "'");
        $selPr->execute();
        $selPr = $selPr->fetchAll();

        foreach ($selPr as $r) {
            $html .= "<tr style='border-bottom:1px solid gray;'>
                <td style='border-right:1px solid gray;'>" . ($i + 1) . ".</td>
                <td id='name'>" . $r["name"] . "<span>";
            if ($r["status"] == "medicine") {
                $html .= "Expiry: " . date("M d,Y", strtotime($r["expiry"]));
            }
            $html .= "</span></td>
                <td id='tax'>&#8377;" . $r["offer_price"] . "</td>
                <td id='quantity'>" . unserialize($row["quantity"])[$i] . "</td>";
            $mulQua = $r["offer_price"] * unserialize($row["quantity"])[$i];
            $html .= "<td id='off_price'>&#8377;" . $mulQua . "</td>
                            </tr>";
            $rate += unserialize($row["offer_price"])[$i];
            $quantity += unserialize($row["quantity"])[$i];
            $subTotal += $mulQua;

            $count++;
        }
    }
    $html .= "</tbody>
                    <tr id='total'>
                        <td></td>
                        <td>TOTAL</td>
                        <td>&#8377;" . $rate . "</td>
                        <td>" . $quantity . "</td>
                        <td>&#8377;" . $subTotal . "</td>
                    </tr>
                </table>
                
                <div id='bill' ";
    if ($count > 4) {
        $html .= "style='page-break-before:always;'";
    }

    if ($row["payment_status"] == "Paid") {
        $html .= ">
                <div id='pay_status' style='color: green;'>Payment Status:&emsp;&emsp;" . $row["payment_status"] . "</div>";
    } else {
        $html .= ">
                <div id='pay_status' style='color: red;'>Payment Status:&emsp;&emsp;" . $row["payment_status"] . "</div>";
    }

    $html .= "<table cellspacing='0'>
                        <tr>
                            <td>SUBTOTAL</td>
                            <td>&#8377;" . $subTotal . "</td>
                        </tr>";

    if ($row["total_price"] < 1000) {
        $html .= "<tr style='border-bottom: 1.5px solid black;'>
                            <td>DELIVERY</td>
                            <td>+&#8377;50</td>
                        </tr>";
    }
    $html .= "<tr>
    <td class='total_amount'><span>TOTAL</span></td>
                        <td class='total_amount'><span>&#8377;" . $row["total_price"] . "</span></td>
                        </tr>
                    </table>
                </div>";
    $html .= "</table>
    </main>
</body>

</html>";
}
