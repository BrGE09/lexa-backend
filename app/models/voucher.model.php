<?php
require './vendor/autoload.php';
require_once './controllers/voucher.controller.php';

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

    public function importCSV()
    {
        $obj = new VoucherController();
        $tipo       = $_FILES['dataCliente']['type'];
        $tamanio    = $_FILES['dataCliente']['size'];
        $archivotmp = $_FILES['dataCliente']['tmp_name'];
        $lineas     = file($archivotmp);

        $i = 0;

        foreach ($lineas as $linea) {
            count($lineas);

            if ($i != 0) {

                $datos = explode(',', $linea);
                $datoImporte = str_replace(['$', ','], '', $datos);

                $NodeRecibo = !empty($datos[0])  ? ($datos[0]) : '0';
                $CIA = !empty($datos[1])  ? ($datos[1]) : '';
                $Cuentadeorigen = !empty($datos[2])  ? ($datos[2]) : '0';
                $idUsuario = !empty($datos[3])  ? ($datos[3]) : '0';
                $SocioComanditario = !empty($datos[4])  ? ($datos[4]) : '';
                $Banco = !empty($datos[5])  ? ($datos[5]) : '';
                $IdBancario = !empty($datos[6])  ? ($datos[6]) : '0';
                $CuentaBancaria = !empty($datos[7])  ? ($datos[7]) : '0';
                $CLABEInterbancaria = !empty($datos[8])  ? ($datos[8]) : '';
                $Importe = !empty($datoImporte[9])  ? ($datoImporte[9]) : '0';
                $Fechaderecibo = !empty($datos[10])  ? ($datos[10]) : '';
                $Status = !empty($datos[11])  ? ($datos[11]) : '';
                $Etapa = !empty($datos[12])  ? ($datos[12]) : '';
                $FechadePago = !empty($datos[13])  ? ($datos[13]) : '';
                $Fechaderecibo = date('y-m-d', strtotime($Fechaderecibo));
                $FechadePago = date('y-m-d', strtotime($FechadePago));

                $obj->createVoucher($NodeRecibo, $CIA, $Cuentadeorigen, $idUsuario, $SocioComanditario, $Banco, $IdBancario, $CuentaBancaria, $CLABEInterbancaria, $Importe, $Fechaderecibo, $Status, $Etapa, $FechadePago);

            }

            $i++;
        }
    }

    public function recibo()
    {
        $obj = new VoucherController();
        $row = $obj->generateVoucher($_REQUEST["folio"]);
        $esp = $this->fecha(new DateTime());

        if (!empty($row)) {

            $formatter = new NumeroALetras();
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

            $salida = "Recibo_Alimentos.jpg";
            imagejpeg($image, $salida);

            echo ("Se ha generado el recibo correctamente como: " . $salida);
            imagedestroy($image);
        }
    }
}
