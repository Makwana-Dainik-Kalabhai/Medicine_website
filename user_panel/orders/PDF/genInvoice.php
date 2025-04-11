<?php

require_once "vendor/autoload.php";

use Dompdf\Dompdf;

$pdf = new Dompdf();

include("Invoice.php");

$pdf->load_html($html);
$pdf->set_option("isRemoteEnabled", true);
$pdf->setPaper("A4", "portrait");
$pdf->render();
$pdf->stream("Invoice.pdf", array("Attachment" => false));