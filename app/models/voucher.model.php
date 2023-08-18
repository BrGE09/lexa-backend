<?php
require 'vendor/autoload.php';
require_once("../controllers/voucher.controller.php");

use Luecano\NumeroALetras\NumeroALetras;

setlocale(LC_ALL, 'es_ES');
date_default_timezone_set('America/Mexico_City');

class VoucherModel
{

    private function fecha($fecha)
    {
        $fechas = date_format($fecha, "d F Y");
        substr($fechas, 0, 10);
        $mes = date('F', strtotime($fechas));
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);

        return array("mes" => $nombreMes);
    }

    public function recibo()
    {
        $obj = new VoucherController();
        $row = $obj->generateVoucher($_GET["folio"]);
        $esp = $this->fecha(new DateTime());

        if (!empty($row)) {

            $formatter = new NumeroALetras(); //Importar libreria de composer
            $formatter->conector = 'Y';
            $importe = $formatter->toMoney($row->import, 2, 'pesos', 'centavos');

            $font = "../../resources/fonts/Arial.ttf";
            $nameImage = "../../resources/image/Alimentos.jpg";
            $image = imagecreatefromjpeg($nameImage);
            $color = imagecolorallocate($image, 0, 0, 0);
            $size = 29;
            $angle = 0;

            $xFolio = 2000;
            $yFolio = 270;
            $folio = $row->folio;

            $cantidad = $importe;
            $xCantidad = 300;
            $yCantidad = 530;

            $cantidadTxt = $importe . " MXN";
            $xCantidadTxt = 800;
            $yCantidadTxt = 530;

            $day = date_format(new DateTime(), "d");
            $xDay = 1160;
            $yDay = 1280;

            $month = $esp["mes"];
            $xMonth = 1700;
            $yMonth = 1280;

            $year = date_format(new DateTime(), "y");
            $xYear = 2180;
            $yYear = 1280;

            $name = $row["partner"];
            $xName = 600;
            $yName = 1418;

            imagettftext($image, $size, $angle, $xFolio, $yFolio, $color, $font, $folio);
            imagettftext($image, $size, $angle, $xCantidad, $yCantidad, $color, $font, $cantidad);
            imagettftext($image, $size, $angle, $xCantidadTxt, $yCantidadTxt, $color, $font, $cantidadTxt);
            imagettftext($image, $size, $angle, $xDay, $yDay, $color, $font, $day);
            imagettftext($image, $size, $angle, $xMonth, $yMonth, $color, $font, $month);
            imagettftext($image, $size, $angle, $xYear, $yYear, $color, $font, $year);
            imagettftext($image, $size, $angle, $xName, $yName, $color, $font, $name);

            $salida = "Recibo_Alimentos.jpg";
            imagejpeg($image, $salida);

            echo ("Se ha generado el recibo correctamente como: " . $salida);
            imagedestroy($image);
        }
    }
}
