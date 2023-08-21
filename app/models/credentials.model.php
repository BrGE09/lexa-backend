<?php

require_once './app/controllers/credentials.controller.php';

class CredentialsModel
{

    public static function newCredential()
    {
        $nombre         = $_REQUEST[""];
        $pass           = $_REQUEST[""];
        $idR            = $_REQUEST[""];
        $fechaRegistro  = $_REQUEST[""];
        $horaRegistro   = $_REQUEST[""];

        $control = new CredentialsController();

        $control->createCredential($nombre, $pass, $idR, $fechaRegistro, $horaRegistro);
    }

    public function verRecords(){

    }
}
