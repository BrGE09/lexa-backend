<?php

include_once "./config/timezone.php";
require_once './vendor/autoload.php';
require_once "./app/controllers/voucher.controller.php";
require_once "./app/controllers/documents.controller.php";

use Luecano\NumeroALetras\NumeroALetras;



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

    public function importCSV()
    {
        $obj = new VoucherController();
        $view = $_FILES['csv']['tmp_name'];

        $fp = fopen(file($view), "r");

        $line = false;

        while ($data = fgetcsv($fp, 0, ",", "\"")) {
            if ($line)
                $obj->createVoucher($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], $data[13]);
            $line = true;
        }

        fclose($fp);
    }

    public function recibo()
    {
        $id  = $_REQUEST["id"];
        $obj = new VoucherController();
        $row = $obj->generateVoucher($id);
        $esp = $this->fecha(new DateTime());

        if (!empty($row)) {

            $formatter = new NumeroALetras();
            $formatter->conector = 'Y';
            $importe = $formatter->toMoney($row->import, 2, 'pesos', 'centavos');

            $font = "./resources/fonts/Arial.ttf";
            $nameImage = "./resources/image/Alimentos.jpg";
            $image = imagecreatefromjpeg($nameImage);
            $color = imagecolorallocate($image, 0, 0, 0);
            $size = 27;
            $angle = 0;

            $xFolio = 2000;
            $yFolio = 270;
            $folio = $row->folio;

            $cantidad = $row->import;
            $xCantidad = 230;
            $yCantidad = 528;

            $cantidadTxt = $importe . " MXN";
            $xCantidadTxt = 800;
            $yCantidadTxt = 528;

            $day = date_format(new DateTime(), "d");
            $xDay = 1160;
            $yDay = 1278;

            $month = $esp["mes"];
            $xMonth = 1700;
            $yMonth = 1278;

            $year = date_format(new DateTime(), "y");
            $xYear = 2180;
            $yYear = 1278;

            $name = $row->partner;
            $xName = 600;
            $yName = 1418;

            imagettftext($image, $size, $angle, $xFolio, $yFolio, $color, $font, $folio);
            imagettftext($image, $size, $angle, $xCantidad, $yCantidad, $color, $font, $cantidad);
            imagettftext($image, $size, $angle, $xCantidadTxt, $yCantidadTxt, $color, $font, $cantidadTxt);
            imagettftext($image, $size, $angle, $xDay, $yDay, $color, $font, $day);
            imagettftext($image, $size, $angle, $xMonth, $yMonth, $color, $font, $month);
            imagettftext($image, $size, $angle, $xYear, $yYear, $color, $font, $year);
            imagettftext($image, $size, $angle, $xName, $yName, $color, $font, $name);

            $salida = "./Recibo_$row->folio.jpg";
            imagejpeg($image, $salida);

            echo ("Se ha generado el recibo correctamente como: " . $salida);
            imagedestroy($image);
        }
    }
}