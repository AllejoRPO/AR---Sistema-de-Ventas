<?php

// Include the main TCPDF library (search for installation path)

require_once('../app/TCPDF-main/tcpdf.php');
include ('../app/config.php');
include ('../app/controllers/ventas/literal.php');

// Iniciar la sesión.
session_start();

// Verificar si la sesión está activa
if (isset($_SESSION['sesion_email'])) {
    // La cuenta está logueada
    $email_sesion = $_SESSION['sesion_email'];

    // Consulta SQL para obtener datos del usuario logueado
    $sql= "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.email as email, rol.rol as rol 
           FROM tb_usuarios as us 
           INNER JOIN tb_roles as rol ON us.id_rol = rol.id_rol 
           WHERE email='$email_sesion'";

    // Preparar y ejecutar la consulta
    $query = $pdo->prepare($sql);
    $query->execute();

    // Obtener los resultados de la consulta
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    // Almacenar los datos del usuario en variables
    foreach ($usuarios as $usuario) {
        $id_usuario_sesion = $usuario['id_usuario'];
        $nombres_sesion = $usuario['nombres'];
        $rol_sesion = $usuario['rol'];
    }
} else {
    // La cuenta no está logueada, redirigir al login
    echo "No está logueada la cuenta ";
    header('location: '.$URL.'/login/login.php');
    exit();
}

$id_venta_get = $_GET['id_venta'];
$nro_venta_get = $_GET['nro_venta'];

// Preparar la consulta SQL para obtener todas las ventas con información adicional.
$sql_ventas = "SELECT ve.*, cli.nombre_cliente, cli.nit_ci_cliente as nit_ci_cliente 
               FROM tb_ventas AS ve INNER JOIN tb_clientes AS cli ON cli.id_cliente = ve.id_cliente WHERE ve.id_venta = '$id_venta_get'";

// Preparar la consulta SQL utilizando PDO
$query_ventas = $pdo->prepare($sql_ventas);

// Ejecutar la consulta
$query_ventas->execute();

// Obtener todos los resultados en forma de array asociativo
$ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);

foreach ($ventas_datos as $ventas_dato) {
    $fyh_creacion = $ventas_dato['fyh_creacion'];
    $nit_ci_cliente = $ventas_dato['nit_ci_cliente'];
    $nombre_cliente = $ventas_dato['nombre_cliente'];
    $total_pagado = $ventas_dato['total_pagado'];
}

//convierte precio total a literal
$monto_literal = numtoletras($total_pagado);

$fecha = date("d/m/y H:i:s", strtotime($fyh_creacion));

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
$pdf->setMargins(15, 15, 15);

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
$pdf->setFont('Helvetica', '', 12);

// Add a page
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = '
<table border="0" style="font-size: 11px">
    <tr>
        <td style="text-align: center; width: 250px">
        <img src="../public/images/ar.png" alt="Logo sistema de eventas" width="80px"><br>
            <b>SISTEMA DE VENTAS AR</b> <br>
            Calle 69A Carrera 98 - 5 Robledo La Huerta <br>
            604 273 31 87 - 323 294 99 29 <br>
            MEDELLÍN - ANTIOQUÍA
        </td>
        <td style="width: 130px"></td>
        <td style="font-size: 16px; width: 290px"><br>
            <b>Nit: </b>985523981-9 <br>
            <b>Nro factura: </b>'.$id_venta_get.' <br>
            <b>Nro de autorización: </b>00019890920
            <p STYLE="text-align: center"><b>ORIGINAL</b></p>
        </td>
    </tr>
</table>
<p style="text-align: center; font-size: 25px"><b>FACTURA DE VENTA</b></p>

<div style="border: 1px solid #000000">
    <table border="0" cellpadding="5px">
        <tr>
            <td><b>Fecha: </b>'.$fecha.'</td>
            <td></td>
            <td><b>Nit/CI: </b>'.$nit_ci_cliente.'</td>
        </tr>
        <tr>
        <td colspan="3"><b>Senor(es): </b>'.$nombre_cliente.'</td>
        </tr>
    </table>
</div>

<br>
<table border="1" cellpadding="5px" style="font-size: 11px">
    <tr style="text-align: center; background-color: #ded9d9">
        <th style="width: 38px"><b>Nro</b></th>
        <th style="width: 164px"><b>Producto</b></th>
        <th style="width: 230px"><b>Descripción</b></th>
        <th style="width: 58px"><b>Cantidad</b></th>
        <th style="width: 85px"><b>Precio Unidad</b></th>
        <th style="width: 80px"><b>SubTotal</b></th>
    </tr>
';

$contador_de_carrito = 0;
$cantidad_total = 0;
$precio_unitario_total = 0;
$precio_total = 0;

$sql_carrito = "SELECT *, pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_producto 
                FROM tb_carrito as carr INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto 
                WHERE nro_venta = '$nro_venta_get' ORDER BY id_carrito ASC ";

$query_carrito = $pdo->prepare($sql_carrito);
$query_carrito->execute();
$carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);

foreach ($carrito_datos as $carrito_dato) {
    $id_carrito = $carrito_dato['id_carrito'];
    $contador_de_carrito = $contador_de_carrito + 1;
    $cantidad_total = $cantidad_total + $carrito_dato ['cantidad'];
    $precio_unitario_total = $precio_unitario_total + floatval($carrito_dato ['precio_venta']);
    $subtotal = $carrito_dato['cantidad'] * $carrito_dato['precio_venta'];
    $precio_total = $precio_total + $subtotal;

    $html .='
    <tr>
        <td style="text-align: center">'.$contador_de_carrito.'</td>
        <td style="text-align: center">'.$carrito_dato['nombre_producto'].'</td>
        <td style="text-align: center">'.$carrito_dato['descripcion'].'</td>
        <td style="text-align: center">'.$carrito_dato['cantidad'].'</td>
        <td style="text-align: center">$ '.$carrito_dato['precio_venta'].'</td>
        <td style="text-align: center">$ '.$subtotal.'</td>
    </tr>
    ';
}

$html .='
    <tr style="background-color: #ded9d9">
        <td colspan="3" style="text-align: right"><b>Total: </b></td>
        <td style="text-align: center">'.$cantidad_total.'</td>
        <td style="text-align: center">$ '.$precio_unitario_total.'</td>
        <td style="text-align: center">$ '.$precio_total.'</td>
    </tr>
</table>

<p style="text-align: right">
    <b>Monto total: </b> $ '.$precio_total.'
</p>
<p><b>Son: </b>'.$monto_literal.'
</p>
<br>----------------------------------------------------------<br>
<b>Usuario: </b>'.$nombres_sesion.' <br>
<p style="text-align: center">""ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO INADECUADO DE SU INFORMACIÓN SERÁ SANCIONADO DE ACUERDO CON LA LEY VIGENTE""
</p>
<p style="text-align: center"><b>GRACIAS POR SU PREFERENCIA</b>
</p>

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

$QR = 'Factura realizada por el Sistema de Ventas AR, al cliente '.$nombre_cliente.' con Cédula '.$nit_ci_cliente.' con fecha y hora: '.$fecha.' con el monto total de: '.$precio_total.'';
$pdf->write2DBarcode($QR,  'QRCODE,L', 170, 240, 40, 40, $style);

// Close and output PDF document
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
