<?php

require_once "vendor/autoload.php";

use Dompdf\Dompdf;

$pdf = new Dompdf();

include("C:/xampp/htdocs/php/PDF/resume.php");

$pdf->load_html($html);
$pdf->set_option("isRemoteEnabled", true);
$pdf->setPaper("A4", "portrait");
$pdf->render();
$pdf->stream("Generate.pdf", array("Attachment" => false));