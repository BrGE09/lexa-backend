<?php

include_once "./config/timezone.php";
require_once './app/controllers/records.controller.php';

class RecordsModel
{

    public static function newRecord()
    {

        $control = new RecordsController();
        $ahora = new DateTime();

        $nombre      = $_REQUEST["name"];
        $apM         = $_REQUEST["last_name"];
        $apP         = $_REQUEST["mother_last_name"];
        $fNacimiento = $_REQUEST["birth_date"];
        $calle       = $_REQUEST["street"];
        $noExt       = $_REQUEST["outdoor_number"];
        $noInt       = $_REQUEST["number"];
        $colonia     = $_REQUEST["cologne"];
        $ciudad      = $_REQUEST["city"];
        $estado      = $_REQUEST["state"];
        $cp          = $_REQUEST["cp"];
        $curp        = $_REQUEST["curp"];
        $rfc         = $_REQUEST["rfc"];
        $correo      = $_REQUEST["email"];
        $nombreCta   = $_REQUEST["name_holder_cb"];
        $idBanco     = $_REQUEST["id_banks"];
        $clabe       = $_REQUEST["account_clabe_cb"];
        $fechaRgtro  = $ahora->format("Y-m-d");
        $hrRegistro  = $ahora->format("h:i:s");
        $hrAct       = $ahora->format("Y-m-d h:i:s");

        $control->createRecord($nombre, $apM, $apP, $fNacimiento, $calle, $noExt, $noInt, $colonia, $ciudad, $estado, $cp, $curp, $rfc, $correo, $nombreCta, $idBanco, $clabe, $fechaRgtro, $hrRegistro, $hrAct);
    }

    public function verRecords(){

    }
}
