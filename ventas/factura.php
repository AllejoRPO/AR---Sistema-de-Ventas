<?php

// Include the main TCPDF library (search for installation path)

require_once('../app/TCPDF-main/tcpdf.php');
include ('../app/config.php');

$id_venta_get = $_GET['id_venta'];
$nro_venta_get = $_GET['nro_venta'];

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215, 279), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Alejandro Rpo sistema de ventas');
$pdf->setTitle('Factura de venta');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(5, 5, 5);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// Set font
$pdf->setFont('Helvetica', '', 7);

// Add a page
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = '
<div>
    <h1>Hola</h1>
    
</div>

';

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, true, false,'');

$style = array(
    'border' => 0,
    'vpadding' => '3',
    'hpadding' => '3',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1,
    'module_height' => 1
);

$QR = 'Factura realizada por el sistema de ventas AR, al cliente Pamela Molina con Cédula 1040518401';
$pdf->write2DBarcode($QR,  'QRCODE,L', 22, 105, 35, 35, $style);

// Close and output PDF document
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
