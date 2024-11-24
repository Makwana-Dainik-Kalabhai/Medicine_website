<?php

require_once "vendor/autoload.php";

use Dompdf\Dompdf;

$pdf = new Dompdf();

include("C:/xampp/htdocs/php/medicine_website/user_panel/orders/PDF/Invoice.php");

$pdf->load_html($html);
$pdf->set_option("isRemoteEnabled", true);
$pdf->setPaper("A4", "portrait");
$pdf->render();
$pdf->stream("Invoice.pdf", array("Attachment" => false));