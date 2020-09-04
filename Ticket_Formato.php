<?php
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('America/Lima');
require_once('cado/ClaseTicket.php');
require __DIR__ . '/Impresora.php'; 
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

//$texto="<div style='width: 90%; border: solid; background-color: #000000; color: #FFF' >Pronto Será Llamado en Admisión </div>";
$oticket=new Tickets();
$nombre_impresora="TICKET"; 
$fecha=$oticket->FechaCastellano(date('d-m-Y H:i:s'));

$nro_ticket=$oticket->GenerarTicket();

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
#Mando un numero de respuesta para saber que se conecto correctamente.
//echo 1;

# Vamos a alinear al centro lo próximo que imprimamos
$printer->setJustification(Printer::JUSTIFY_CENTER);


$logo=EscposImage::load('img/LogoTicket.png',false);
$printer->bitImage($logo);
$printer->feed(2);
$printer -> setTextSize(2,1);
$printer->text('"Cuidándote mejor,'."\n".'Siempre" '."\n");
$printer->feed(2);
$printer -> setTextSize(6,4);
$printer->text($nro_ticket."\n");

$printer->feed(2);
$printer -> setTextSize(1,1);
$printer->text('Av. Santa Victoria 416, Chiclayo - Perú'."\n");
$printer->text($fecha.'    '.date('H:i a')."\n");
$printer->feed(2);
$logo_footer=EscposImage::load('img/llamado.png',false);
$printer->bitImage($logo_footer);
$printer->feed(3);
$printer->cut();

$printer->pulse();
$printer->close();

?>
